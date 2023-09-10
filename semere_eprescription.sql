-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 11, 2023 at 12:41 PM
-- Server version: 5.7.40
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `semere_eprescription`
--

-- --------------------------------------------------------

--
-- Table structure for table `activitylog`
--

DROP TABLE IF EXISTS `activitylog`;
CREATE TABLE IF NOT EXISTS `activitylog` (
  `activityLogId` int(11) NOT NULL AUTO_INCREMENT,
  `fromUsersId` int(11) NOT NULL,
  `action` varchar(250) NOT NULL,
  `ipAddress` varchar(20) NOT NULL,
  `osType` varchar(100) NOT NULL,
  `deviceType` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `actionTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `toUsersId` int(11) NOT NULL,
  PRIMARY KEY (`activityLogId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL,
  `Woreda` varchar(100) NOT NULL,
  `Zone` varchar(100) NOT NULL,
  `State` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `approvallog`
--

DROP TABLE IF EXISTS `approvallog`;
CREATE TABLE IF NOT EXISTS `approvallog` (
  `approvalLogId` int(11) NOT NULL AUTO_INCREMENT,
  `roleRequestId` int(11) NOT NULL,
  `rolesId` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `fromStatus` enum('Pending','Approved','Denied') NOT NULL,
  `toStatus` enum('Pending','Approved','Denied') NOT NULL,
  `changeDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `changedBy` int(11) NOT NULL,
  `Reason` varchar(250) NOT NULL,
  PRIMARY KEY (`approvalLogId`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approvallog`
--

INSERT INTO `approvallog` (`approvalLogId`, `roleRequestId`, `rolesId`, `usersId`, `fromStatus`, `toStatus`, `changeDate`, `changedBy`, `Reason`) VALUES
(32, 23, 2, 66, 'Pending', 'Approved', '2019-10-17 10:23:47', 22, 'wel'),
(33, 3, 2, 33, 'Pending', 'Approved', '2023-06-24 14:02:08', 22, 'googd'),
(34, 3, 2, 33, 'Pending', 'Approved', '2023-06-24 14:02:11', 22, 'googd'),
(35, 3, 2, 33, 'Pending', 'Approved', '2023-06-24 14:02:15', 22, 'googd'),
(36, 3, 2, 33, 'Pending', 'Approved', '2023-06-24 14:02:19', 22, 'good'),
(37, 3, 2, 33, 'Pending', 'Approved', '2023-06-24 14:02:23', 22, 'good'),
(38, 3, 2, 33, 'Pending', 'Approved', '2023-06-24 14:02:29', 22, 'good'),
(39, 3, 2, 33, 'Pending', 'Approved', '2023-06-24 14:02:32', 22, 'good'),
(40, 3, 2, 33, 'Pending', 'Approved', '2023-06-24 14:02:36', 22, 'good'),
(41, 3, 2, 33, 'Pending', 'Denied', '2023-06-24 14:02:39', 22, 'good'),
(42, 3, 2, 33, 'Denied', 'Approved', '2023-06-24 14:02:54', 22, 'i need to approve'),
(43, 6, 3, 34, 'Pending', 'Approved', '2023-06-28 09:43:50', 22, 'approved\r\n'),
(44, 11, 3, 35, 'Pending', 'Approved', '2023-06-28 11:47:11', 22, 'Approved'),
(45, 13, 3, 36, 'Pending', 'Approved', '2023-06-28 12:18:01', 22, 'approved'),
(46, 16, 3, 37, 'Pending', 'Approved', '2023-06-28 12:37:06', 22, 'approved'),
(47, 18, 3, 38, 'Pending', 'Approved', '2023-06-28 12:51:41', 22, 'approved'),
(48, 21, 3, 39, 'Pending', 'Approved', '2023-06-28 13:15:38', 22, 'approved'),
(49, 26, 2, 40, 'Pending', 'Approved', '2023-06-29 05:57:39', 22, 'approve'),
(50, 34, 2, 42, 'Pending', 'Approved', '2023-07-01 11:49:31', 22, 'Approved\r\n'),
(51, 36, 4, 42, 'Pending', 'Approved', '2023-07-10 08:30:12', 22, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `countryId` int(11) NOT NULL AUTO_INCREMENT,
  `countryName` varchar(100) NOT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`countryId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`countryId`, `countryName`, `isDeleted`) VALUES
(1, 'Ethiopia', 0),
(2, 'Kenya', 0),
(3, 'Uganda', 0),
(4, 'Rwanda', 0),
(5, 'Eritrea', 0);

-- --------------------------------------------------------

--
-- Table structure for table `drugformulary`
--

DROP TABLE IF EXISTS `drugformulary`;
CREATE TABLE IF NOT EXISTS `drugformulary` (
  `drugFormularyId` int(11) NOT NULL AUTO_INCREMENT,
  `drugsId` int(11) NOT NULL,
  `indications` longtext NOT NULL,
  `cautions` longtext NOT NULL,
  `contraindications` longtext NOT NULL,
  `drugInteractions` longtext NOT NULL,
  `sideEffects` longtext NOT NULL,
  `doseAndAdministration` longtext NOT NULL,
  `storage` longtext NOT NULL,
  PRIMARY KEY (`drugFormularyId`)
) ENGINE=InnoDB AUTO_INCREMENT=620 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drugformulary`
--

INSERT INTO `drugformulary` (`drugFormularyId`, `drugsId`, `indications`, `cautions`, `contraindications`, `drugInteractions`, `sideEffects`, `doseAndAdministration`, `storage`) VALUES
(475, 517, 'ulcer and non ulcer dyspepsia; gastro-oesphageal reflux disease (GERD), hyperphosphatemia', 'See notes above, uremia, congestive heart failure, renal failureandrenal dialysis, edema, cirrhosis, low sodium diets, gastrointestinal hemorrhage, and elderly', 'Contraindications: see notes above, hypophosphatemia, undiagnosed gastro intestinal or rectal bleeding; appendicitis; porphyria.', 'allupurinol, antibiotics (tetracycline, quinolones, some cephalosporins), biphosphonate derivatives, corticosteroids, cyclosporine, iron salts, imidazole antifungals, isoniazide, phenytoin, phenothiazines- absorption will be decreased; citric acid derivatives may decrease absorption of aluminum hydroxide. See also notes above', 'see notes above, constipation, stomach cramps, fecal impaction, nausea, vomiting, and discoloration of feces, hypophosphatemia, and hypomagnesemia. Dose and Administration:Dyspepsia,', 'Dyspepsia, gastro-oesophageal reflux disease (GERD): Oral: Adult: 5â€“10 ml suspension 4 times daily between meals and at bedtime. Child: 6â€“12 years 5 ml up to three times daily Hyperphosphatemia: Oral: Adult: 2â€“10 g daily in divided doses with meals Note: Do not take other medicines within 2â€“4 hours of aluminium hydroxide preparations.', 'at room temperature, avoid freezing.'),
(476, 518, 'ulcer and non ulcer dyspepsia; gastro-oesphageal reflux disease (GERD), hyperphosphatemia', 'See notes above, uremia, congestive heart failure, renal failureandrenal dialysis, edema, cirrhosis, low sodium diets, gastrointestinal hemorrhage, and elderly', 'Contraindications: see notes above, hypophosphatemia, undiagnosed gastro intestinal or rectal bleeding; appendicitis; porphyria.', 'allupurinol, antibiotics (tetracycline, quinolones, some cephalosporins), biphosphonate derivatives, corticosteroids, cyclosporine, iron salts, imidazole antifungals, isoniazide, phenytoin, phenothiazines- absorption will be decreased; citric acid derivatives may decrease absorption of aluminum hydroxide. See also notes above', ': see notes above, constipation, stomach cramps, fecal impaction, nausea, vomiting, and discoloration of feces, hypophosphatemia, and hypomagnesemia. Dose and Administration:Dyspepsia,', 'Dyspepsia, gastro-oesophageal reflux disease (GERD): Oral: Adult: 5â€“10 ml suspension 4 times daily between meals and at bedtime. Child: 6â€“12 years 5 ml up to three times daily Hyperphosphatemia: Oral: Adult: 2â€“10 g daily in divided doses with meals Note: Do not take other medicines within 2â€“4 hours of aluminium hydroxide preparations.', 'at room temperature, avoid freezing.'),
(477, 519, 'ulcer and non ulcer dyspepsia; gastro-oesphageal reflux disease (GERD), hyperphosphatemia', 'See notes above, uremia, congestive heart failure, renal failureandrenal dialysis, edema, cirrhosis, low sodium diets, gastrointestinal hemorrhage, and elderly', 'Contraindications: see notes above, hypophosphatemia, undiagnosed gastro intestinal or rectal bleeding; appendicitis; porphyria.', 'allupurinol, antibiotics (tetracycline, quinolones, some cephalosporins), biphosphonate derivatives, corticosteroids, cyclosporine, iron salts, imidazole antifungals, isoniazide, phenytoin, phenothiazines- absorption will be decreased; citric acid derivatives may decrease absorption of aluminum hydroxide. See also notes above', ': see notes above, constipation, stomach cramps, fecal impaction, nausea, vomiting, and discoloration of feces, hypophosphatemia, and hypomagnesemia. Dose and Administration:Dyspepsia,', 'Dyspepsia, gastro-oesophageal reflux disease (GERD): Oral: Adult: 5â€“10 ml suspension 4 times daily between meals and at bedtime. Child: 6â€“12 years 5 ml up to three times daily Hyperphosphatemia: Oral: Adult: 2â€“10 g daily in divided doses with meals Note: Do not take other medicines within 2â€“4 hours of aluminium hydroxide preparations.', 'at room temperature, avoid freezing.'),
(478, 520, 'see under individual preparations and notes above. Note: a combination of Aluminium Hydroxide and Magnesium Hydroxide may reduce adverse gastro-intestinal effects. Another advantage of combined antacid formulations is that a slow-acting antacid aluminium hydroxide may be combined\nwith a more rapidly acting agent such as magnesium hydroxide\nto improve the onset and duration of effect.', 'see under individual preparations and notes above. Note: a combination of Aluminium Hydroxide and Magnesium Hydroxide may reduce adverse gastro-intestinal effects. Another advantage of combined antacid formulations is that a slow-acting antacid aluminium hydroxide may be combined\nwith a more rapidly acting agent such as magnesium hydroxide\nto improve the onset and duration of effect.', 'see under individual preparations and notes above. Note: a combination of Aluminium Hydroxide and Magnesium Hydroxide may reduce adverse gastro-intestinal effects. Another advantage of combined antacid formulations is that a slow-acting antacid aluminium hydroxide may be combined\nwith a more rapidly acting agent such as magnesium hydroxide\nto improve the onset and duration of effect.', 'see under individual preparations and notes above. Note: a combination of Aluminium Hydroxide and Magnesium Hydroxide may reduce adverse gastro-intestinal effects. Another advantage of combined antacid formulations is that a slow-acting antacid aluminium hydroxide may be combined\nwith a more rapidly acting agent such as magnesium hydroxide\nto improve the onset and duration of effect.', 'see under individual preparations and notes above. Note: a combination of Aluminium Hydroxide and Magnesium Hydroxide may reduce adverse gastro-intestinal effects. Another advantage of combined antacid formulations is that a slow-acting antacid aluminium hydroxide may be combined\nwith a more rapidly acting agent such as magnesium hydroxide\nto improve the onset and duration of effect.', 'Oral: shake the bottle well before\nuse. 5-10 ml (2 teasponfuls) or 1-2 tablets every 6 hours usually\nbetween meals and at bedtime, or as required.', 'at room temperature'),
(479, 521, 'see under individual preparations and notes above. Note: a combination of Aluminium Hydroxide and Magnesium Hydroxide may reduce adverse gastro-intestinal effects. Another advantage of combined antacid formulations is that a slow-acting antacid aluminium hydroxide may be combined\nwith a more rapidly acting agent such as magnesium hydroxide\nto improve the onset and duration of effect.', 'see under individual preparations and notes above. Note: a combination of Aluminium Hydroxide and Magnesium Hydroxide may reduce adverse gastro-intestinal effects. Another advantage of combined antacid formulations is that a slow-acting antacid aluminium hydroxide may be combined\nwith a more rapidly acting agent such as magnesium hydroxide\nto improve the onset and duration of effect.', 'see under individual preparations and notes above. Note: a combination of Aluminium Hydroxide and Magnesium Hydroxide may reduce adverse gastro-intestinal effects. Another advantage of combined antacid formulations is that a slow-acting antacid aluminium hydroxide may be combined\nwith a more rapidly acting agent such as magnesium hydroxide\nto improve the onset and duration of effect.', 'see under individual preparations and notes above. Note: a combination of Aluminium Hydroxide and Magnesium Hydroxide may reduce adverse gastro-intestinal effects. Another advantage of combined antacid formulations is that a slow-acting antacid aluminium hydroxide may be combined\nwith a more rapidly acting agent such as magnesium hydroxide\nto improve the onset and duration of effect.', 'see under individual preparations and notes above. Note: a combination of Aluminium Hydroxide and Magnesium Hydroxide may reduce adverse gastro-intestinal effects. Another advantage of combined antacid formulations is that a slow-acting antacid aluminium hydroxide may be combined\nwith a more rapidly acting agent such as magnesium hydroxide\nto improve the onset and duration of effect.', 'Oral: shake the bottle well before\nuse. 5-10 ml (2 teasponfuls) or 1-2 tablets every 6 hours usually\nbetween meals and at bedtime, or as required.', 'at room temperature'),
(480, 522, 'temporary relief of hyperacidity associated with\ngas; may also be used for indications associated with other\nantacids', 'see under individual preparations and notes\nabove.\nNote: Simethicone, antiflatulent, has been added as an aid in those\nconditions in which the retention of gas may be a problem', 'see under individual preparations and notes above.\nNote: Simethicone, antiflatulent, has been added as an aid in those\nconditions in which the retention of gas may be a problem', 'see under individual preparations and notes above.\nNote: Simethicone, antiflatulent, has been added as an aid in those\nconditions in which the retention of gas may be a problem', 'see under individual preparations and notes above.\nNote: Simethicone, antiflatulent, has been added as an aid in those\nconditions in which the retention of gas may be a problem', 'Oral: Adult: 10-20ml 4-6 times /\nday between meals and at bedtime; may be used every hour for severe symptoms.', 'at room temperature.'),
(481, 523, 'see under individual preparations and notes above.', 'see under individual preparations and notes\nabove', 'see under individual preparations and notes above', 'see under individual preparations and notes above', 'see under individual preparations and notes  above', 'Oral:Adult: shake the bottle well before use. 5-10 ml (2 teasponfuls) every 6 hours usually between meals and at bedtime, or as required. Note: Chew 1 - 2 tablets when required.', 'at room temperature.\nNote: Magnesim trisilicate is often given in conjunction with other antacids in order to reduce adverse gastro-intestinal effects'),
(482, 524, 'see under individual preparations and notes above.', 'see under individual preparations and notes\nabove', 'see under individual preparations and notes above', 'see under individual preparations and notes above', 'see under individual preparations and notes  above', 'Oral:Adult: shake the bottle well before use. 5-10 ml (2 teasponfuls) every 6 hours usually between meals and at bedtime, or as required. Note: Chew 1 - 2 tablets when required.', 'at room temperature.\nNote: Magnesim trisilicate is often given in conjunction with other antacids in order to reduce adverse gastro-intestinal effects'),
(483, 525, 'used as an antacid, and treatment or prevention of calcium deficiency or hyperphosphatemia.', 'renal impairment; renal calculi; hypercalcemia;\nhypophosphatemia', '', 'thiazide diuretics, levothyroxine, digoxin, tetracycline, atenolol, iron, quinolones, sodium fluoride, and\nverapamil', 'headache, hypophosphatemia, hypercalcaemia, constipation, laxative effect, acid rebound, nausea, vomiting,\nanorexia, abdominal pain, xerostomia, and flatulence.', 'Oral: Adult: Antacid: 1-2 tablets\nevery 2 hours; maximum 7000 mg per 24 hours.', ''),
(484, 526, 'ulcer and non-ulcer dyspepsia; GERD', 'renal impairment, hypermagnesemia, hepatic\nimpairment, notes above.', 'see notes above, hypersensitivity to any component of the formulation, severe renal impairment.', 'as for Aluminum hydroxide, also see notes above', 'diarrhoea, abdominal cramps, muscle weakness,respiratory depression, hypermagnesemia and hypotension.', 'Tablet, Adult:Chew 2 - 4 tablets repeated according to patients needs with maximum daily dose of 16 tablets. Child (7-14 years): one tablet with maximum of 4 tablets per day. Mixture, Adult: 5 -15 ml repeated according to patient\'s needs with maximum daily dose of 60 ml. Child: 2.5-5ml as needed up to 4 times /day.', 'at room temperature, avoid freezing'),
(485, 527, 'ulcer and non-ulcer dyspepsia; GERD', 'renal impairment, hypermagnesemia, hepatic\nimpairment, notes above.', 'see notes above, hypersensitivity to any component of the formulation, severe renal impairment.', 'as for Aluminum hydroxide, also see notes above', 'diarrhoea, abdominal cramps, muscle weakness,respiratory depression, hypermagnesemia and hypotension.', 'Tablet, Adult:Chew 2 - 4 tablets repeated according to patients needs with maximum daily dose of 16 tablets. Child (7-14 years): one tablet with maximum of 4 tablets per day. Mixture, Adult: 5 -15 ml repeated according to patient\'s needs with maximum daily dose of 60 ml. Child: 2.5-5ml as needed up to 4 times /day.', 'at room temperature, avoid freezing'),
(486, 528, 'see notes above', 'see notes above', 'see notes above', 'see notes above', 'see notes above, silica renal stones; diarrhea.', 'Oral, Chew 2 tablets as required.Note: the antacid action is exerted slowly, so it does not give such rapid symptomatic relief as magnesium hydroxide', ''),
(487, 529, '', '', '', '', '', '', ''),
(488, 530, '', '', '', '', '', '', ''),
(489, 531, 'benign gastric and duodenal  ulceration, stomach  ulceration, GERD, Zollinger-Ellison syndrome, and other conditions where gastric acid reduction is beneficial.', 'hepatic impairment; renal impairment; pregnancy; breastfeeding; middle aged or older patients and in those whose symptom change may mask gastric cancer; preferably avoid\nintravenous injection (use intravenous infusion) particularly in high dosage and in cardiovascular impairment (risk of arrhythmias).', 'hypersensitivity to the drug.', 'tricyclic antidepressants, benzodiazepines,metoprolol, propranolol, carbamazepine, phenytoin,\nprocainamide, quinidine, theophylline, valproic acid, azole antifungals and warfarin.', 'gastrointestinal disturbances, headache, dizziness,  somnolence, diarrhea, rash and tiredness; reversible confusional\nstates, gynaecomastia and impotence, hypersensitivity reactions (rare), less commonly tachycardia; rarely interstitial nephritis;very rarely pancreatitis, galactorrhoea, vasculitis, alopecia.', '', 'store in airtight containers at a temperature of 15 to\n30oc. Protect from light'),
(490, 532, 'benign gastric and duodenal  ulceration, stomach  ulceration, GERD, Zollinger-Ellison syndrome, and other conditions where gastric acid reduction is beneficial.', 'hepatic impairment; renal impairment; pregnancy; breastfeeding; middle aged or older patients and in those whose symptom change may mask gastric cancer; preferably avoid\nintravenous injection (use intravenous infusion) particularly in high dosage and in cardiovascular impairment (risk of arrhythmias).', 'hypersensitivity to the drug.', 'tricyclic antidepressants, benzodiazepines,metoprolol, propranolol, carbamazepine, phenytoin,\nprocainamide, quinidine, theophylline, valproic acid, azole antifungals and warfarin.', 'gastrointestinal disturbances, headache, dizziness,  somnolence, diarrhea, rash and tiredness; reversible confusional\nstates, gynaecomastia and impotence, hypersensitivity reactions (rare), less commonly tachycardia; rarely interstitial nephritis;very rarely pancreatitis, galactorrhoea, vasculitis, alopecia.', '', 'store in airtight containers at a temperature of 15 to\n30oc. Protect from light'),
(491, 533, 'benign gastric and duodenal  ulceration, stomach  ulceration, GERD, Zollinger-Ellison syndrome, and other conditions where gastric acid reduction is beneficial.', 'hepatic impairment; renal impairment; pregnancy; breastfeeding; middle aged or older patients and in those whose symptom change may mask gastric cancer; preferably avoid\nintravenous injection (use intravenous infusion) particularly in high dosage and in cardiovascular impairment (risk of arrhythmias).', 'hypersensitivity to the drug.', 'tricyclic antidepressants, benzodiazepines,metoprolol, propranolol, carbamazepine, phenytoin,\nprocainamide, quinidine, theophylline, valproic acid, azole antifungals and warfarin.', 'gastrointestinal disturbances, headache, dizziness,  somnolence, diarrhea, rash and tiredness; reversible confusional\nstates, gynaecomastia and impotence, hypersensitivity reactions (rare), less commonly tachycardia; rarely interstitial nephritis;very rarely pancreatitis, galactorrhoea, vasculitis, alopecia.', '', 'store in airtight containers at a temperature of 15 to\n30oc. Protect from light'),
(492, 534, 'see under dose', 'see under cimetidine above', '', 'see under cimetidine above', 'sweating, rarely vasculitis, hyperuricaemia, exfoliative dermatitis', 'Adult: Oral: Benign gastric, duodenal or NSAID associated ulceration, treatment, 300mg in the evening or 150 mg twice daily for 4-8 weeks; maintenance, 150mg at night; Gastro-oesophageal reflux disease: 150-300mg twice daily for up to 12 weeks.IV infusion: for short term use in peptic ulcer hospital inpatients as alternative to oral route, by intermittent IV infusion over 15 minutes, 100mg 3 times daily, or by continuous IV infusion,10mg/hour; max 480mg daily.Child not recommended', 'store injections between 4-30oC; and tablet between\n15-30oC'),
(493, 535, 'see under dose', 'see under cimetidine above', '', 'see under cimetidine above', 'sweating, rarely vasculitis, hyperuricaemia, exfoliative dermatitis', '', ''),
(494, 536, 'benign gastric and duodenal ulceration, GERD, Zollingerâ€“Ellison syndrome, other conditions where gastric acid reduction is beneficial', 'see under cimetidine above', '', 'ranitidine does not appear to bind to microsomal cytochrome P450 thus the potential for interactions is less than with cimetidine; sacralfate reduces absorption of ranitidine.', 'see under cimetidine above', 'Benign gastric and duodenal ulceration: oral:Adult: 150 mg twice daily or 300 mg at night for 4â€“8 weeks, up to 6 weeks in chronic episodic dyspepsia, and\nup to 8 weeks in NSAID-associated ulceration (in duodenal ulcer 300 mg can be given twice daily for 4 weeks to achieve a higher healing rate);maintenance, 150 mg at night;Child:(peptic ulcer) 2â€“4 mg/kg twice daily, maximum 300 mg\ndaily. Benign gastric and duodenal ulceration, reflux\noesophagitis, Zollingerâ€“Ellison syndrome: IM: Adult: 50 mg every 6â€“8 hours or by slow intravenous injection, 50 mg diluted to 20 ml and given over at least 2 minutes, may be repeated every 6â€“8 hours or by intravenous infusion, 25 mg/hour for 2 hours, may be repeated every 6â€“8 hours.Prophylaxis of NSAIDinduced duodenal ulcer: oral: Adult: 150 mg twice daily. Reflux oesophagitis: oral:Adult: 150 mg twice daily or 300 mg at night for up to 8 weeks, or if necessary 12 weeks (moderate to severe, 150 mg 4 times daily for up to 12 weeks); long-term\ntreatment of healed oesophagitis, 150 mg twice daily. Zollingerâ€“Ellison syndrome: oral:Adult: 150 mg 3 times daily; up to 6 g daily in divided doses has been used.Gastric acid reduction (prophylaxis of acid aspiration) in obstetrics: oral:Adult: 150 mg at onset of labour, then every 6 hours; surgical procedures, IM or slow IV injection: Adult: 50 mg 45â€“ 60 minutes before induction of anaesthesia (intravenous injection diluted to 20 ml and given over at least 2 minutes), or orally, 150 mg 2 hours before induction of anaesthesia, and\nalso, when possible on the preceding evening.Prophylaxis of stress ulceration: Adult: initial slow IV injection of 50 mg diluted to 20 ml and given over at least 2 minutes then by continuous IV infusion, 125â€“250 micrograms/kg per hour (may be followed by 150 mg twice daily by mouth when oral feeding\ncommences). Use half normal dose if eGFR less than 50 mL/minute/1.73 m2', 'store injections between 4-30oC; and tablet between\n15-30oC.'),
(495, 537, 'benign gastric and duodenal ulceration, GERD, Zollingerâ€“Ellison syndrome, other conditions where gastric acid reduction is beneficial', 'see under cimetidine above', '', 'ranitidine does not appear to bind to microsomal cytochrome P450 thus the potential for interactions is less than with cimetidine; sacralfate reduces absorption of ranitidine.', 'see under cimetidine above', 'Benign gastric and duodenal ulceration: oral:Adult: 150 mg twice daily or 300 mg at night for 4â€“8 weeks, up to 6 weeks in chronic episodic dyspepsia, and\nup to 8 weeks in NSAID-associated ulceration (in duodenal ulcer 300 mg can be given twice daily for 4 weeks to achieve a higher healing rate);maintenance, 150 mg at night;Child:(peptic ulcer) 2â€“4 mg/kg twice daily, maximum 300 mg\ndaily. Benign gastric and duodenal ulceration, reflux\noesophagitis, Zollingerâ€“Ellison syndrome: IM: Adult: 50 mg every 6â€“8 hours or by slow intravenous injection, 50 mg diluted to 20 ml and given over at least 2 minutes, may be repeated every 6â€“8 hours or by intravenous infusion, 25 mg/hour for 2 hours, may be repeated every 6â€“8 hours.Prophylaxis of NSAIDinduced duodenal ulcer: oral: Adult: 150 mg twice daily. Reflux oesophagitis: oral:Adult: 150 mg twice daily or 300 mg at night for up to 8 weeks, or if necessary 12 weeks (moderate to severe, 150 mg 4 times daily for up to 12 weeks); long-term\ntreatment of healed oesophagitis, 150 mg twice daily. Zollingerâ€“Ellison syndrome: oral:Adult: 150 mg 3 times daily; up to 6 g daily in divided doses has been used.Gastric acid reduction (prophylaxis of acid aspiration) in obstetrics: oral:Adult: 150 mg at onset of labour, then every 6 hours; surgical procedures, IM or slow IV injection: Adult: 50 mg 45â€“ 60 minutes before induction of anaesthesia (intravenous injection diluted to 20 ml and given over at least 2 minutes), or orally, 150 mg 2 hours before induction of anaesthesia, and\nalso, when possible on the preceding evening.Prophylaxis of stress ulceration: Adult: initial slow IV injection of 50 mg diluted to 20 ml and given over at least 2 minutes then by continuous IV infusion, 125â€“250 micrograms/kg per hour (may be followed by 150 mg twice daily by mouth when oral feeding\ncommences). Use half normal dose if eGFR less than 50 mL/minute/1.73 m3', 'store injections between 4-30oC; and tablet between\n15-30oC.'),
(496, 538, 'protection against NSAID associated gastric and\nduodenal ulceration. Misoprostol is a synthetic prostaglandin E1\nanalogue used to inhibit gastric acid secreation by a direct action on\nthe parietal cells and also have mucosal protectant property.', 'renal impairment and elderly, inflammatory bowel\ndisease (may exacerbate intestinal inflamation and produce\nsevere diarrhea); patients prone to dehydration or in whom its\nconsequence would be dangerous. Patients should understand\nmisoprostolâ€™s abortifacient properties and attendant risks, and\nthat the medicineis intended only for their use for the specific\ncondition for which it was prescribed.', 'pregnancy and allergy to prostaglandins.', 'oxytocin, diclofenac, phenylbutazone', 'diarrhoea is the most common side effects (may\noccasionally be severe and require withdrawal, reduced by giving single doses not exceeding 200 micrograms and by avoiding magnesium-containing antacids); abdominal pain, dyspepsia, flatulence, and nausea and vomiting, increased utrine Contractility,abnormal viginal\nBleeding (including intermenstrual bleeding, menorrhagia, and postmenopausal\nbleeding), skin rashes, headache, dizziness, and constipation.', 'Adult: Oral: Prevention against\nNSAID associated duodenal ulcer: 800 mcg/day in four divided\ndoses, with meals and at bedtime. Where appropriate, NSAIDs\nshould be taken simultaneously.Prevention against NSAID associated gastric ulcer: 200mcg twice daily with food and the prescribed NSAID; increased to\n200mcg three times daily (maximum 200 mcg 4 times daily) to\ncorrespond with the NSAID administration schedule or if\nclinically indicated. Misoprostol therapy should be started at the\nonset of treatment with NSAIDs, and continue for the duration\nof NSAIDs therapy. If required, antacids may be administered\nbefore or after misoprostol for the relief of pain. However,\nmagnesium-containing antacids are not recommended since\nthey may aggravate misoprostol-induced diarrhea.', 'store at or below 25oC.\nNote:Taking with food or milk will lessen adverse effects such as\nloose stools, diarrhea, and abdominal cramping'),
(497, 539, 'see under dose and administration.', 'see under omeprazole', 'see under omeprazole', 'see under omeprazole', 'see under omeprazole', 'Oral: Erosive reflux\noesophagitis: 40mg once daily for 4-8 weeks. Maintenance to\nprevent relapse, 20mg once daily. GERD (without\noesophagitis):20mg once daily for 4 weeks. NSAID-associated\ngastric ulcer: adult over 18 years, 20 mg once daily for 4â€“8\nweeks; prophylaxis in patients with an increased risk of\ngastroduodenal complications who require continued NSAID\ntreatment, 20 mg daily. Zollingerâ€“Ellison syndrome: adult over\n18 years, initially 40 mg twice daily, adjusted according to\nresponse; usual range 80â€“160 mg daily (above 80 mg in 2\ndivided doses). Eradication ofH. pylori: esomeprazole 20mg\nplus amoxicillin 1g and clarithromycin 500mg, all twice daily\nfor 7 days.\nIV over at least 3 minutes or by intravenous infusion, adult over\n18 years, gastro-oesophageal reflux disease, 40 mg once daily;symptomatic reflux disease without oesophagitis, treatment of\nNSAID-associated gastric ulcer, prevention of NSAID-\nassociated gastric or duodenal ulcer, 20 mg daily; continue until\noral administration possible. Severe peptic ulcer bleeding\n(following endoscopic treatment), adult over 18 years, initial\nintravenous infusion of 80 mg over 30 minutes, then by\ncontinuous intravenous infusion 8 mg/hour for 72 hours, then\nby mouth 40 mg once daily for 4 weeks', 'see under omeprazole'),
(498, 540, 'see under dose and administration.', 'see under omeprazole', 'see under omeprazole', 'see under omeprazole', 'see under omeprazole', 'Oral: Erosive reflux\noesophagitis: 40mg once daily for 4-8 weeks. Maintenance to\nprevent relapse, 20mg once daily. GERD (without\noesophagitis):20mg once daily for 4 weeks. NSAID-associated\ngastric ulcer: adult over 18 years, 20 mg once daily for 4â€“8\nweeks; prophylaxis in patients with an increased risk of\ngastroduodenal complications who require continued NSAID\ntreatment, 20 mg daily. Zollingerâ€“Ellison syndrome: adult over\n18 years, initially 40 mg twice daily, adjusted according to\nresponse; usual range 80â€“160 mg daily (above 80 mg in 2\ndivided doses). Eradication ofH. pylori: esomeprazole 20mg\nplus amoxicillin 1g and clarithromycin 500mg, all twice daily\nfor 7 days.\nIV over at least 3 minutes or by intravenous infusion, adult over\n18 years, gastro-oesophageal reflux disease, 40 mg once daily;symptomatic reflux disease without oesophagitis, treatment of\nNSAID-associated gastric ulcer, prevention of NSAID-\nassociated gastric or duodenal ulcer, 20 mg daily; continue until\noral administration possible. Severe peptic ulcer bleeding\n(following endoscopic treatment), adult over 18 years, initial\nintravenous infusion of 80 mg over 30 minutes, then by\ncontinuous intravenous infusion 8 mg/hour for 72 hours, then\nby mouth 40 mg once daily for 4 weeks', 'see under omeprazole'),
(499, 541, 'see under dose and administration.', 'see under omeprazole', 'see under omeprazole', 'see under omeprazole', 'see under omeprazole', 'Oral: Erosive reflux\noesophagitis: 40mg once daily for 4-8 weeks. Maintenance to\nprevent relapse, 20mg once daily. GERD (without\noesophagitis):20mg once daily for 4 weeks. NSAID-associated\ngastric ulcer: adult over 18 years, 20 mg once daily for 4â€“8\nweeks; prophylaxis in patients with an increased risk of\ngastroduodenal complications who require continued NSAID\ntreatment, 20 mg daily. Zollingerâ€“Ellison syndrome: adult over\n18 years, initially 40 mg twice daily, adjusted according to\nresponse; usual range 80â€“160 mg daily (above 80 mg in 2\ndivided doses). Eradication ofH. pylori: esomeprazole 20mg\nplus amoxicillin 1g and clarithromycin 500mg, all twice daily\nfor 7 days.\nIV over at least 3 minutes or by intravenous infusion, adult over\n18 years, gastro-oesophageal reflux disease, 40 mg once daily;symptomatic reflux disease without oesophagitis, treatment of\nNSAID-associated gastric ulcer, prevention of NSAID-\nassociated gastric or duodenal ulcer, 20 mg daily; continue until\noral administration possible. Severe peptic ulcer bleeding\n(following endoscopic treatment), adult over 18 years, initial\nintravenous infusion of 80 mg over 30 minutes, then by\ncontinuous intravenous infusion 8 mg/hour for 72 hours, then\nby mouth 40 mg once daily for 4 weeks', 'see under omeprazole'),
(500, 542, 'see under dose and administration.', 'see under omeprazole', 'see under omeprazole', 'see under omeprazole', 'see under omeprazole', 'Oral: Erosive reflux\noesophagitis: 40mg once daily for 4-8 weeks. Maintenance to\nprevent relapse, 20mg once daily. GERD (without\noesophagitis):20mg once daily for 4 weeks. NSAID-associated\ngastric ulcer: adult over 18 years, 20 mg once daily for 4â€“8\nweeks; prophylaxis in patients with an increased risk of\ngastroduodenal complications who require continued NSAID\ntreatment, 20 mg daily. Zollingerâ€“Ellison syndrome: adult over\n18 years, initially 40 mg twice daily, adjusted according to\nresponse; usual range 80â€“160 mg daily (above 80 mg in 2\ndivided doses). Eradication ofH. pylori: esomeprazole 20mg\nplus amoxicillin 1g and clarithromycin 500mg, all twice daily\nfor 7 days.\nIV over at least 3 minutes or by intravenous infusion, adult over\n18 years, gastro-oesophageal reflux disease, 40 mg once daily;symptomatic reflux disease without oesophagitis, treatment of\nNSAID-associated gastric ulcer, prevention of NSAID-\nassociated gastric or duodenal ulcer, 20 mg daily; continue until\noral administration possible. Severe peptic ulcer bleeding\n(following endoscopic treatment), adult over 18 years, initial\nintravenous infusion of 80 mg over 30 minutes, then by\ncontinuous intravenous infusion 8 mg/hour for 72 hours, then\nby mouth 40 mg once daily for 4 weeks', 'see under omeprazole'),
(501, 543, 'see under dose and administration.', 'under omeprazole. Contraindicated in liver\nimpairment.', 'under omeprazole. Contraindicated in liver\nimpairment.', 'under omeprazole. Contraindicated in liver\nimpairment.', 'under omeprazole. Contraindicated in liver\nimpairment.', 'Adult: Oral: 30mg daily for 2-8\nweeks depending on the condition. Prevention of GERD: 15mg\ndaily for upto 1 year. No efficacy or safety data available for\ntherapy longer than 1 year. Functional dyspepsia: 15mg daily\nfor 2-4 weeks. Eradication of H. pylori: see under\nomeprazole.Heartburn and hyperacidity: 15mg daily for up to\n14 days', 'under omeprazole. Contraindicated in liver\nimpairment.'),
(502, 544, 'see under dose and administration.', 'under omeprazole. Contraindicated in liver\nimpairment.', 'under omeprazole. Contraindicated in liver\nimpairment.', 'under omeprazole. Contraindicated in liver\nimpairment.', 'under omeprazole. Contraindicated in liver\nimpairment.', 'Adult: Oral: 30mg daily for 2-8\nweeks depending on the condition. Prevention of GERD: 15mg\ndaily for upto 1 year. No efficacy or safety data available for\ntherapy longer than 1 year. Functional dyspepsia: 15mg daily\nfor 2-4 weeks. Eradication of H. pylori: see under\nomeprazole.Heartburn and hyperacidity: 15mg daily for up to\n14 days', 'under omeprazole. Contraindicated in liver\nimpairment.'),
(503, 545, 'see under dose and administration.', 'under omeprazole. Contraindicated in liver\nimpairment.', 'under omeprazole. Contraindicated in liver\nimpairment.', 'under omeprazole. Contraindicated in liver\nimpairment.', 'under omeprazole. Contraindicated in liver\nimpairment.', 'Adult: Oral: 30mg daily for 2-8\nweeks depending on the condition. Prevention of GERD: 15mg\ndaily for upto 1 year. No efficacy or safety data available for\ntherapy longer than 1 year. Functional dyspepsia: 15mg daily\nfor 2-4 weeks. Eradication of H. pylori: see under\nomeprazole.Heartburn and hyperacidity: 15mg daily for up to\n14 days', 'under omeprazole. Contraindicated in liver\nimpairment.'),
(504, 546, 'management of gastric and duodenal ulcers, reflux\noesophagitis and Zollinger Ellison syndrome; also eradication\nof H. Pylori in combination with appropriate antibiotics', 'pregnancy, lactating women, liver disease;\nporphyria.', 'known hypersensitivity to the drug, exclude\nmalignancy', 'diazepam, warfarin, phenytoin, fluoxetin,\npropranolol, indinavir, ketoconazole, and carbamazepine.', 'diarrhoea, headache, skin rashes, nausea,\nvomiting, constipation, flatulence and abdominal pain, pruritus,\nurticaria, dizziness', 'Oral:Adult: Active duodenal ulcer:\n20mg/day for 4-8 weeks. Gastric ulcers: 40mg/day for 4-8\nweeks. NSAID-associated erosions: 20mg daily for 4-8 weeks.\nPrevention, 20mg daily. Eradication of H.pylori: 20mg twice\ndaily or 40 mg once daily for 7-14 days in combination with\nappropriate antibiotics (clarithromycin 500 mg twice daily,\namoxicillin 1 g twice daily, or as an alternative amoxicillin 1 g\ntwice daily, metronidazole 500 mg (or tinidazole 500mg) twice\ndaily). Zollinger-Ellison syndrome: initially 60mg once daily;\ndosages range 20- 120mg/day, with doses over 80mg given in 2\ndivided doses. Gastric acid reduction during general anaesthesia\n(prophylaxis of acid aspiration), 40 mg on the preceding\nevening then 40 mg 2â€“6 hours before surgery.Child: Severe\nulcerative reflux oesophagitis: 10-20kg, 10mg once daily,\nincreased to 20mg daily if necessary; over 20kg, 20mg once\ndaily, increased to 40mg daily if necessary.', 'store at room temperature.\nNote:-Taking the medication at least 1 hour before a meal will have\nmaximum benefit.'),
(505, 547, 'management of gastric and duodenal ulcers, reflux\noesophagitis and Zollinger Ellison syndrome; also eradication\nof H. Pylori in combination with appropriate antibiotics', 'pregnancy, lactating women, liver disease;\nporphyria.', 'known hypersensitivity to the drug, exclude\nmalignancy', 'diazepam, warfarin, phenytoin, fluoxetin,\npropranolol, indinavir, ketoconazole, and carbamazepine.', 'diarrhoea, headache, skin rashes, nausea,\nvomiting, constipation, flatulence and abdominal pain, pruritus,\nurticaria, dizziness', 'Oral:Adult: Active duodenal ulcer:\n20mg/day for 4-8 weeks. Gastric ulcers: 40mg/day for 4-8\nweeks. NSAID-associated erosions: 20mg daily for 4-8 weeks.\nPrevention, 20mg daily. Eradication of H.pylori: 20mg twice\ndaily or 40 mg once daily for 7-14 days in combination with\nappropriate antibiotics (clarithromycin 500 mg twice daily,\namoxicillin 1 g twice daily, or as an alternative amoxicillin 1 g\ntwice daily, metronidazole 500 mg (or tinidazole 500mg) twice\ndaily). Zollinger-Ellison syndrome: initially 60mg once daily;\ndosages range 20- 120mg/day, with doses over 80mg given in 2\ndivided doses. Gastric acid reduction during general anaesthesia\n(prophylaxis of acid aspiration), 40 mg on the preceding\nevening then 40 mg 2â€“6 hours before surgery.Child: Severe\nulcerative reflux oesophagitis: 10-20kg, 10mg once daily,\nincreased to 20mg daily if necessary; over 20kg, 20mg once\ndaily, increased to 40mg daily if necessary.', 'store at room temperature.\nNote:-Taking the medication at least 1 hour before a meal will have\nmaximum benefit.'),
(506, 548, 'benign gastric ulcer, Gastro-oesophageal reflux\ndisease (GERD), duodenal ulcer, duodenal ulcer associated with\nHelicobacter pylori, Prophylaxis of NSAID-associated gastric\nor duodenal ulcer in patients with an increased risk of\ngastroduodenal complications who require continued NSAID\ntreatment,\nZollingerâ€“Ellison\nsyndrome\n(and\nother\nhypersecretory conditions).', 'should be used with caution in patients with liver\ndisease, in pregnancy and in breast-feeding. May mask the\nsymptoms of gastric cancer; particular care is required in those\npresenting with â€˜alarm features in such cases gastric malignancy\nshould be ruled out before treatment,renal impairment', 'sensitivity to pantoprazole, hepatic disease', '', 'gastro-intestinal disturbances (including nausea,\nvomiting, abdominal pain, flatulence, diarrhoea, constipation),\nand headache. Less frequent side-effects include dry mouth,\nperipheral oedema, dizziness, sleep disturbances, fatigue,\nparaesthesia, arthralgia, myalgia, rash, and pruritus. And also\nsee the above note.', 'benign gastric ulcer: oral:adultover\n18 years, 40 mg daily in the morning for 4 weeks, continued for\nfurther 4 weeks if not fully healed.\nGastro-oesophageal reflux disease (GERD): adult and child\nover 12 years: 20â€“40 mg daily in the morning for 4 weeks,\ncontinued for further 4 weeks if not fully healed; maintenance\n20 mg daily, increased to 40 mg daily if symptoms return.\nDuodenal ulcer: adultover 18 years: 40 mg daily in the morning\nfor 2 weeks, continued for further 2 weeks if not fully\nhealed.Duodenal ulcer associated with Helicobacter pylori\n(eradication): pantoprzole 40mg twice daily + clarithromycin\n250mg twice daily+ metronidazole 400mg twice daily. If a\npatient has been treated with metronidazole for other infections\npantoprzole 40mg twice daily +amoxicicilin 1g twice daily +\nclarithromycin 500mg three times daily.Prophylaxis of NSAID-\nassociated gastric or duodenal ulcer in patients with an\nincreased risk of gastroduodenal complications who require\ncontinued NSAID treatment: adult over 18 years: 20 mg daily.Zollingerâ€“Ellison syndrome (and other hypersecretory\nconditions): adultover 18 years: initially 80 mg once daily\nadjusted according to response (elderly max. 40 mg daily); daily\ndoses above 80 mg given in 2 divided doses', ''),
(507, 549, 'as part of a multidrug regimen for H.pylori\neradication to reduce the risk of duodenal ulcer recurrence.', 'patients taking asprin, children < 3 years of age and\nthose with viral illness.', 'hypersensitivity to the medicine, severe GI\nbleeding, history of coagulopathy, pregnancy (3rd trimester),\nrenal impairment.', 'warfarin, aspirin, hypoglycemics,\ntetracyclines and uricosurics.', 'anxiety, confusion, headache, discoloration of the\ntongue, grayish black stools, hearing loss, tinnitus, nausea and\nvomiting.', 'Adult: Oral: 524mg four times/day\nwith meals and at bedtime; requires combination therapy.', 'store in airtight containers and protect from light.'),
(508, 550, 'as part of a multidrug regimen for H.pylori\neradication to reduce the risk of duodenal ulcer recurrence.', 'patients taking asprin, children < 3 years of age and\nthose with viral illness.', 'hypersensitivity to the medicine, severe GI\nbleeding, history of coagulopathy, pregnancy (3rd trimester),\nrenal impairment.', 'warfarin, aspirin, hypoglycemics,\ntetracyclines and uricosurics.', 'anxiety, confusion, headache, discoloration of the\ntongue, grayish black stools, hearing loss, tinnitus, nausea and\nvomiting.', 'Adult: Oral: 524mg four times/day\nwith meals and at bedtime; requires combination therapy.', 'store in airtight containers and protect from light.'),
(509, 551, 'used as a mucosal protectant for the treatment of\npeptic ulcer disease; active against Helicobacter pylori and has\nbeen used as triple therapy (with metronidazole and either\ntetracycline or amoxicillin) to eradicate this organism and\ntherby prevent relapse of duodenal ulcer.', 'see under bismuth subsalicylate', 'see under bismuth subsalicylate', 'see under bismuth subsalicylate', 'see under bismuth subsalicylate', 'Adult: Oral: Gastric and Duodenal\nulceration: 240mg twice daily or 120mg four times daily before\nmeals for 4 weeks, extended to 8 weeks if necessary. When\nused as part of triple therapy 120mg 4 times daily for 2 weeks.', 'see under bismuth subsalicylate'),
(510, 552, 'used as a mucosal protectant for the treatment of\npeptic ulcer disease; active against Helicobacter pylori and has\nbeen used as triple therapy (with metronidazole and either\ntetracycline or amoxicillin) to eradicate this organism and\ntherby prevent relapse of duodenal ulcer.', 'see under bismuth subsalicylate', 'see under bismuth subsalicylate', 'see under bismuth subsalicylate', 'see under bismuth subsalicylate', 'Adult: Oral: Gastric and Duodenal\nulceration: 240mg twice daily or 120mg four times daily before\nmeals for 4 weeks, extended to 8 weeks if necessary. When\nused as part of triple therapy 120mg 4 times daily for 2 weeks.', 'see under bismuth subsalicylate'),
(511, 553, 'for treatment of gastric and duodenal ulcers,\nchronic gastritis and reflux oesophagitis.', 'renal impairment.', 'hypersensitivity of the medicine', 'other antacids, tetracyclines, phenytoin, oral\nanticoagulants, digoxin, cimetidine.', 'constipation, diarrhoea, nausea, abdominal\ndiscomfort and indigestion.', 'Oral: 1g 4 times daily, 1\nhour before meals and at bedtime. In duodenal ulcer, 2g twice\ndaily has also been shown to be effective.Maintenance 1g twice\ndaily, half an hour before morning and evening meals.', 'store at room tempertature.'),
(512, 554, 'dyspepsia, irritable bowel syndrome, diverticular\ndisease; preoperative medication to inhibit salivation and\nsecretions; mydriasis and cycloplegia; organophosphate or\ncarbamate insecticide poisoning (section 17); see also notes\nabove.', '', '', '', '', 'Adult:IM, S.C., I.V: 0.4 - 0.6 mg\nevery four to six hours. Child:SC: 0.01 mg/kg of body weight,\nnot to exceed 0.4 mg, every four to six hours.', 'at room temperature, protect from freezing.'),
(513, 555, 'used in the treatment of functional disturbances of\nGI motility such as irritable bowel syndrome, see also notes\nabove.', 'see notes above\nThe precautions and contraindications associated with\nchlordiazepoxide must be considered', 'The precautions and contraindications associated with\nchlordiazepoxide must be considered', 'The precautions and contraindications associated with\nchlordiazepoxide must be considered', 'The precautions and contraindications associated with\nchlordiazepoxide must be considered', 'Oral: one or two tablets 3\nor 4 times daily (i.e. 2.5 or 5 mg of Clidinium bromide 3 or 4\ntimes a day)', 'store at room temperature in a tight, light resistant\ncontainer'),
(514, 556, 'smooth muscle spasm in connection with biliary\ntract\ndiseases:\ncholecystolithiasis,\ncholangiolithiasis,\ncholecystitis, pericholecystitis, cholangitis, and papillitis.\nSmooth muscle spasm in connection with urinary tract diseases:\nnephrolithiasis, ureterolithiasis, pyelitis, cystitis, and cramp of\nurinary bladder', 'hypotension, people with lactase insufficiency,\ngalactosaemia', 'hypersensitivity reactions; severe hepatic,\nrenal and cardiac insufficiency; children < 1 year of age', 'hosphodiesterase inhibitors like papverine\ndecrease the antiparkinsonian effect of levodopa.', 'gastrointestinal disorders (nausea, constipation);\nnervous system disorders (headache, dizziness, insomnia);\ncardiovascular disorders (palpitation, hypotension)', 'the usual average daily dose\nis 120-240 mg/day (in 2-3 divided doses).\nChild > 1 year old: 40-120 mg/day divided in 2 to 3 doses\nbetween 1 and 6 years. 80-200 mg/day divided in 2 to 5 doses\nover 6 years.', 'store at a temperature not exceeding 25 oC'),
(515, 557, 'smooth muscle spasm in connection with biliary\ntract\ndiseases:\ncholecystolithiasis,\ncholangiolithiasis,\ncholecystitis, pericholecystitis, cholangitis, and papillitis.\nSmooth muscle spasm in connection with urinary tract diseases:\nnephrolithiasis, ureterolithiasis, pyelitis, cystitis, and cramp of\nurinary bladder', 'hypotension, people with lactase insufficiency,\ngalactosaemia', 'hypersensitivity reactions; severe hepatic,\nrenal and cardiac insufficiency; children < 1 year of age', 'hosphodiesterase inhibitors like papverine\ndecrease the antiparkinsonian effect of levodopa.', 'gastrointestinal disorders (nausea, constipation);\nnervous system disorders (headache, dizziness, insomnia);\ncardiovascular disorders (palpitation, hypotension)', 'the usual average daily dose\nis 120-240 mg/day (in 2-3 divided doses).\nChild > 1 year old: 40-120 mg/day divided in 2 to 3 doses\nbetween 1 and 6 years. 80-200 mg/day divided in 2 to 5 doses\nover 6 years.', 'store at a temperature not exceeding 25 oC'),
(516, 558, 'symptomatic relief of visceral spasms of the\ngastro-intestinal tract, painful spasm of the biliary and genito-\nurinary system, bowel colic and excessive respiratory\nsecretions.', 'see notes above', 'see notes above', 'CNS depressants see also notes above.', 'see notes above', 'Adult:Oral: Smooth muscle\nspasm: 20mg four times daily; IM or IV (acute spasm and\nspasm in diagnostic procedures), 20 mg repeated after 30\nminutes if necessary. (May be repeated more frequently in\nendoscopy), maximum 100 mg daily.\nIrritable bowel syndrome: 10 mg 3 times daily, increased if\nrequired up to 20 mg 4 times daily.Child:Oral: 6-12 years,\n10mg 3 times daily; parenteral use not recommended', 'at room temperature, in a well-closed container.\nNote: Scopolamine (hyoscine) hydrobromide should not be\ninterchanged with scopolamine butylbromide formulations. Dosages\nare not equivalent.'),
(517, 559, 'symptomatic relief of visceral spasms of the\ngastro-intestinal tract, painful spasm of the biliary and genito-\nurinary system, bowel colic and excessive respiratory\nsecretions.', 'see notes above', 'see notes above', 'CNS depressants see also notes above.', 'see notes above', 'Adult:Oral: Smooth muscle\nspasm: 20mg four times daily; IM or IV (acute spasm and\nspasm in diagnostic procedures), 20 mg repeated after 30\nminutes if necessary. (May be repeated more frequently in\nendoscopy), maximum 100 mg daily.\nIrritable bowel syndrome: 10 mg 3 times daily, increased if\nrequired up to 20 mg 4 times daily.Child:Oral: 6-12 years,\n10mg 3 times daily; parenteral use not recommended', 'at room temperature, in a well-closed container.\nNote: Scopolamine (hyoscine) hydrobromide should not be\ninterchanged with scopolamine butylbromide formulations. Dosages\nare not equivalent.'),
(518, 560, 'symptomatic relief of visceral spasms of the\ngastro-intestinal tract, painful spasm of the biliary and genito-\nurinary system, bowel colic and excessive respiratory\nsecretions.', 'see notes above', 'see notes above', 'CNS depressants see also notes above.', 'see notes above', 'Adult:Oral: Smooth muscle\nspasm: 20mg four times daily; IM or IV (acute spasm and\nspasm in diagnostic procedures), 20 mg repeated after 30\nminutes if necessary. (May be repeated more frequently in\nendoscopy), maximum 100 mg daily.\nIrritable bowel syndrome: 10 mg 3 times daily, increased if\nrequired up to 20 mg 4 times daily.Child:Oral: 6-12 years,\n10mg 3 times daily; parenteral use not recommended', 'at room temperature, in a well-closed container.\nNote: Scopolamine (hyoscine) hydrobromide should not be\ninterchanged with scopolamine butylbromide formulations. Dosages\nare not equivalent.'),
(519, 561, 'symptomatic relief of visceral spasms of the\ngastro-intestinal tract, painful spasm of the biliary and genito-\nurinary system, bowel colic and excessive respiratory\nsecretions.', 'see notes above', 'see notes above', 'CNS depressants see also notes above.', 'see notes above', 'Adult:Oral: Smooth muscle\nspasm: 20mg four times daily; IM or IV (acute spasm and\nspasm in diagnostic procedures), 20 mg repeated after 30\nminutes if necessary. (May be repeated more frequently in\nendoscopy), maximum 100 mg daily.\nIrritable bowel syndrome: 10 mg 3 times daily, increased if\nrequired up to 20 mg 4 times daily.Child:Oral: 6-12 years,\n10mg 3 times daily; parenteral use not recommended', 'at room temperature, in a well-closed container.\nNote: Scopolamine (hyoscine) hydrobromide should not be\ninterchanged with scopolamine butylbromide formulations. Dosages\nare not equivalent.'),
(520, 562, 'prevention and control of motion sickness, and\nalso used as an adjunct to anesthesia to inhibit salivation and\nexcessive respiratory secretions and to produce sedative and\namnesia; see also notes above. Not indicated for peptic ulcer.\nNote: Hyoscine butylbromide is preferable to hyoscine hydrobromide\nin the relief of visceral spasms of the gastro-intestinal tract and pain\nassociated with other smooth muscle spasm.', 'see notes above', 'see notes above', 'CNS depression - producing medications;\nsee notes above.', 'see notes above', 'Adult:Oral: 0.3 mg 30 minutes\nbefore a journey to prevent motion sickness then 0.3 mg every 6\nhours if required up to a maximum of 3 doses in 24 hours;IM,\nIV, or SC, 0.3 to 0.6 mg; if necessary, the dose may be repeated\n3 or 4 times daily.\nChild: Oral: aged 4 to 10 years, 75 to 150 microgram and those\nover 10 years, 150 to 300 microgram; IM, IV, or SC, 0.006\nmg/Kg', 'store in a light - resistant container at room\ntemperature. Protect from freezing.'),
(521, 563, 'prevention and control of motion sickness, and\nalso used as an adjunct to anesthesia to inhibit salivation and\nexcessive respiratory secretions and to produce sedative and\namnesia; see also notes above. Not indicated for peptic ulcer.\nNote: Hyoscine butylbromide is preferable to hyoscine hydrobromide\nin the relief of visceral spasms of the gastro-intestinal tract and pain\nassociated with other smooth muscle spasm.', 'see notes above', 'see notes above', 'CNS depression - producing medications;\nsee notes above.', 'see notes above', 'Adult:Oral: 0.3 mg 30 minutes\nbefore a journey to prevent motion sickness then 0.3 mg every 6\nhours if required up to a maximum of 3 doses in 24 hours;IM,\nIV, or SC, 0.3 to 0.6 mg; if necessary, the dose may be repeated\n3 or 4 times daily.\nChild: Oral: aged 4 to 10 years, 75 to 150 microgram and those\nover 10 years, 150 to 300 microgram; IM, IV, or SC, 0.006\nmg/Kg', 'store in a light - resistant container at room\ntemperature. Protect from freezing.');
INSERT INTO `drugformulary` (`drugFormularyId`, `drugsId`, `indications`, `cautions`, `contraindications`, `drugInteractions`, `sideEffects`, `doseAndAdministration`, `storage`) VALUES
(522, 564, 'adjunctive treatment of peptic ulcer, irritable\nbowel syndrome, pancreatitis, ureteral and urinary bladder\nspasm (urinary frequency); reduce duodenal motility during\ndiagnostic radiologic procedure, gustatory sweating.', 'see notes above', 'see notes above', 'see notes above', 'see notes above', 'Oral: Antisecretory: Adult: 15 mg\n3 times/day before meals or food and 30mg at bedtime,\nmaximum 120 mg daily. Child: 1-2 mg/kg/day in 3-4 divided\ndoses. Elderly: 7.5 mg 3 times/day before meals and at\nbedtime. Antispasmodic: Adult: 15mg 3 times/day before\nmeals or food and 30mg at bedtime max. 120 mg daily.Child:\n2-3mg/kg/day in divided doses every 4-6 hours and at bedtime', 'at room temperature in a well closed container'),
(523, 565, 'For the prevention and control of severe nausea\nand vomiting, other indications \nNote: It should not be used for motion sickness', 'see section 4.2 under chlorpromazine', 'see section 4.2 under chlorpromazine', 'see section 4.2 under chlorpromazine', 'see section 4.2 under chlorpromazine', 'Adult: Oral: 12.5 â€“25mg every 4 â€“\n6 hours, as necessary. Slow, deep I.M: 25 mg as a single dose,\nthe dosage being increased to 25 â€“ 50mg every 3 â€“ 4 hours until\nvomiting stops; it is then given orally if necessary. Child (6\nmonth and over): Oral or slow, deep I.M: 0.55mg/kg every 6 â€“\n8 Hour As necessary.', 'at room temperature. Protect from light and freezing.\nDo not use if solution is markedly discolored or if a precipitate\nis present.\nNote: Patients should remain lying down for at least 30 minutes after\ninjection.'),
(524, 566, 'For the prevention and control of severe nausea\nand vomiting, other indications \nNote: It should not be used for motion sickness', 'see section 4.2 under chlorpromazine', 'see section 4.2 under chlorpromazine', 'see section 4.2 under chlorpromazine', 'see section 4.2 under chlorpromazine', 'Adult: Oral: 12.5 â€“25mg every 4 â€“\n6 hours, as necessary. Slow, deep I.M: 25 mg as a single dose,\nthe dosage being increased to 25 â€“ 50mg every 3 â€“ 4 hours until\nvomiting stops; it is then given orally if necessary. Child (6\nmonth and over): Oral or slow, deep I.M: 0.55mg/kg every 6 â€“\n8 Hour As necessary.', 'at room temperature. Protect from light and freezing.\nDo not use if solution is markedly discolored or if a precipitate\nis present.\nNote: Patients should remain lying down for at least 30 minutes after\ninjection.'),
(525, 567, 'For the prevention and control of severe nausea\nand vomiting, other indications \nNote: It should not be used for motion sickness', 'see section 4.2 under chlorpromazine', 'see section 4.2 under chlorpromazine', 'see section 4.2 under chlorpromazine', 'see section 4.2 under chlorpromazine', 'Adult: Oral: 12.5 â€“25mg every 4 â€“\n6 hours, as necessary. Slow, deep I.M: 25 mg as a single dose,\nthe dosage being increased to 25 â€“ 50mg every 3 â€“ 4 hours until\nvomiting stops; it is then given orally if necessary. Child (6\nmonth and over): Oral or slow, deep I.M: 0.55mg/kg every 6 â€“\n8 Hour As necessary.', 'at room temperature. Protect from light and freezing.\nDo not use if solution is markedly discolored or if a precipitate\nis present.\nNote: Patients should remain lying down for at least 30 minutes after\ninjection.'),
(526, 568, 'For the prevention and control of severe nausea\nand vomiting, other indications \nNote: It should not be used for motion sickness', 'see section 4.2 under chlorpromazine', 'see section 4.2 under chlorpromazine', 'see section 4.2 under chlorpromazine', 'see section 4.2 under chlorpromazine', 'Adult: Oral: 12.5 â€“25mg every 4 â€“\n6 hours, as necessary. Slow, deep I.M: 25 mg as a single dose,\nthe dosage being increased to 25 â€“ 50mg every 3 â€“ 4 hours until\nvomiting stops; it is then given orally if necessary. Child (6\nmonth and over): Oral or slow, deep I.M: 0.55mg/kg every 6 â€“\n8 Hour As necessary.', 'at room temperature. Protect from light and freezing.\nDo not use if solution is markedly discolored or if a precipitate\nis present.\nNote: Patients should remain lying down for at least 30 minutes after\ninjection.'),
(527, 569, 'prevention and treatment of nausea, vomiting\nand/or vertigo associated with motion sickness;see also notes\nabove', 'as for meclizine hydrochloride; also pregnant and\nnursing mothers', '', 'as for meclizine hydrochloride; ototoxic\ndrugs such as aminoglycoside antibiotics (dimenhydrinate may\nmask the early symptoms of ototoxicity)', 'as for meclizine hydrochloride; also, tinnitus', 'Adult:Oral, 50 to 100 mg every\nfour to six hours. Child:Oral, 6-12 Years of age, 25 to 50 mg\nevery six to eight hours as needed, not to exceed 150 mg per\nday; 2-6 years of age, 12.5 to 25 mg every six to eight hours as\nneeded, not to exceed 75 mg per day.', 'Storage: at room temperature, in a well-closed container.\nNote: Oral dosage forms used for motion sickness should be taken 30\nminutes before motion'),
(528, 570, 'nausea and vomiting, dyspepsia, gastro-\noesophageal reflux', 'children, renal impairment, pregnancy, breast feeding', 'prolactinoma; if increased gastro-intestinal\nmotility harmful, hepatic impairment', 'antimuscarinics,\nbromocriptine,\ncabergoline, erythromycin, ketoconazole, opioid analgesics,\ntelaprevir', 'gastro-intestinal disturbances (including cramps)\nand hyperprolactinaemia; ventricular arrhythmias, agitation,\ndrowsiness, nervousness, seizures, extrapyramidal effects,\nheadache, and rashes; also reported QT-interval prolongation.', 'oral Adult and child body-weight\nover 35 kg, 10â€“20 mg 3â€“4 times daily; max. 80 mg daily; child\nbody-weight up to 35kg (nausea and vomiting only), 250â€“500\nmicrograms/kg 3â€“4 times daily; max.2.4 mg/kg daily.', ''),
(529, 571, 'prevention and treatment of nausea and vomiting\ninduced by cytotoxic chemotherapy or radiotherapy and\npostoperative nausea and vomiting', '', 'hypersensitivity to medicine, other 5-HT3\nreceptor antagonists or any component of the formulation.', 'granisetron may enhance the hypotensive\neffect of apomorphine.', 'constipation, nausea, diarrhoea, vomiting,\nabdominal pain; headache, drowsiness, asthenia; fever; rarely\nhepatic dysfunction, chest pain, arrhythmia; very rarely\nanorexia, dizziness, insomnia, agitation, movement disorders,\nand rash.', 'Nausea and vomiting induced by\ncytotoxic chemotherapy or radiotherapy: Oral, 1â€“2 mg within 1\nhour before start of treatment, then 2 mg daily in 1â€“2 divided\ndoses during treatment; when intravenous infusion also used,\nmaximum combined total 9 mg in 24 hours; CHILD:\n20 micrograms/kg (maximum 1 mg) within 1 hour before start\nof treatment, then 20 micrograms/kg (maximum 1 mg) twice\ndaily for up to 5 days during treatment. By intravenous injection\n(diluted in 15 mL sodium chloride 0.9% and given over not less\nthan 30 seconds) or by intravenous infusion (over 5 minutes),\nprevention, 3 mg before start of cytotoxic therapy (up to 2\nadditional 3-mg doses may be given within 24 hours);\ntreatment, as for prevention (the two additional doses must not\nbe given less than 10 minutes apart); max. 9 mg in 24 hours;\nchild, by intravenous infusion, (over 5 minutes), prevention,\n40 micrograms/kg (max. 3 mg) before start of cytotoxic\ntherapy; treatment, as for preventionâ€”one additional dose of\n40 micrograms/kg (max. 3 mg) may be given within 24 hours\n(not less than 10 minutes after initial dose). Postoperative\nnausea and vomiting: by intravenous injection (diluted to 5 mL\nand given over 30 seconds), prevention, 1 mg before induction\nof anaesthesia; treatment, 1 mg, given as for prevention;\nmaximum 2 mg in one day;\nchild: not recommended', 'Store between 20-250C; Keep container closed tightly.\nProtect from light'),
(530, 572, 'prevention and treatment of nausea, vomiting\nand/or vertigo associated with motion sickness; see also notes\nabove.', 'warn the patients not to perform hazardous activities\nrequiring mental alertness or physical condition; patients with\nangle closure glaucoma or prostatic hypertrophy bladder neck\nobstruction, coma, Jaundice; use with caution in hot weather,\nand during exercise. Elderly may be at risk for anticholinergic\nside effects', 'hypersensitive to the medicine, pregnant\nwomen, children younger than 12 years of age', 'alcohol, CNS depressants including\nbarbiturates, tranquillizers, medicineswith anti cholinergic\neffects including tricyclic antidepressants', 'drowsiness, fatigue and rarely blurred vision,\ndryness of mouth, nose and throat, palpitations, thicknening of\nbronchial secretions, increase appetite, weight gain, arthralgia,\nand pharyngitis.', 'Adult and Child (>12 years of\nage): Motion sickness (prophylaxis and treatment): Oral: 25 to\n50 mg one hour before travel. Dose may be repeated every\ntwenty-four hours as needed. Vertigo (prophylaxis and\ntreatment): Oral: 25 to 100 mg a day as needed; in divided\ndoses.', 'at room temperature, in a well - closed container.'),
(531, 573, 'nausea and vomiting in gastrointestinal disorders\nand treatment with cytotoxics or radiotherapy; gastro-\noesophageal reflux; gastroparesis; premedication and\npostoperatively; aid to gastrointestinal intubation; nausea and\nvomiting in migraine', 'elderly, children and young patients are at increased\nrisk of extrapyramidal reactions; hepatic and renal impairment;\nmay mask underlying disorders such as cerebral irritation, avoid\nfor 3 - 4 days after gastrointestinal surgery; pregnancy; breast\nfeeding; parkinson disease; depression; porphyria; patients\nshould be warned that the drug may impair their ability to\nperform activities requiring mental alertness or physical\ncoordination.', 'convulsive disorders, gastrointestinal\nhemorrhage,\nmechanical\nobstruction\nor\nperforation;\npheochromocytoma; 3â€“4 days after gastrointestinal surgery;\nhypersensitivity to the medicine.', 'alcohol, barbiturates, CNS depressants;\nphenothiazines and butyrophenones, lithium, antidepressants,\nantiepileptics, and sympathomimetics; antimuscarinic agents\nand opioid analgesics; digoxin, aspirin or paracetamol,\nsuxamethonium, bromocriptine.', 'extrapyramidal symptoms (especially in children\nand young adults), tardive dyskinesia on prolonged use;\nhyperprolactinaemia; drowsiness, restlessness, dizziness,\nheadache, diarrhoea, depression, hypotension and hypertension;\nrarely, neuroleptic malignant syndrome; cardiac conduction\nabnormalities following IV administration.', 'Nausea and vomiting, gastro-\noesophageal reflux, gastroparesis:\nAdult:Oral or IM, or slow IV injection: 10 mg 3 times daily;\nyoung adult: 15 - 19 years (under 60 Kg) 5 mg 3 times daily;\nChild:Oral, or IM, or slow IV injection: up to 1 year (up to 10\nKg) 1 mg twice daily, 1 - 3 years (10-14 Kg) 1 mg 2 - 3 times\ndaily, 3 - 5 years (15 - 19 Kg) 2 mg 2 - 3 times daily, 5 - 9 years\n(20-28 Kg.) 2.5 mg 3 times daily, 9 - 14 years (30 Kg and over)\n5 mg 3 times daily. (Usual maximum 500 micrograms/Kg daily,\nparticularly for children and young adults); Pre-medication:\nAdult,by slow I.V., 10 mg as a single dose.\nAid to gastrointestinal intubation, Orally, or IM or by Slow\nintravenous injection: Adult: 10 - 20 mg as a single dose 5 - 10\nminutes before examination; Young Adult (15 - 19 years)\n10mg; Child under 3 years 1 mg, 3 - 5 years 2 mg, 5 - 9 years\n2.5 mg, 9 - 14 years 5 mg.', 'at room temperature, protect from light.'),
(532, 574, 'nausea and vomiting in gastrointestinal disorders\nand treatment with cytotoxics or radiotherapy; gastro-\noesophageal reflux; gastroparesis; premedication and\npostoperatively; aid to gastrointestinal intubation; nausea and\nvomiting in migraine', 'elderly, children and young patients are at increased\nrisk of extrapyramidal reactions; hepatic and renal impairment;\nmay mask underlying disorders such as cerebral irritation, avoid\nfor 3 - 4 days after gastrointestinal surgery; pregnancy; breast\nfeeding; parkinson disease; depression; porphyria; patients\nshould be warned that the drug may impair their ability to\nperform activities requiring mental alertness or physical\ncoordination.', 'convulsive disorders, gastrointestinal\nhemorrhage,\nmechanical\nobstruction\nor\nperforation;\npheochromocytoma; 3â€“4 days after gastrointestinal surgery;\nhypersensitivity to the medicine.', 'alcohol, barbiturates, CNS depressants;\nphenothiazines and butyrophenones, lithium, antidepressants,\nantiepileptics, and sympathomimetics; antimuscarinic agents\nand opioid analgesics; digoxin, aspirin or paracetamol,\nsuxamethonium, bromocriptine.', 'extrapyramidal symptoms (especially in children\nand young adults), tardive dyskinesia on prolonged use;\nhyperprolactinaemia; drowsiness, restlessness, dizziness,\nheadache, diarrhoea, depression, hypotension and hypertension;\nrarely, neuroleptic malignant syndrome; cardiac conduction\nabnormalities following IV administration.', 'Nausea and vomiting, gastro-\noesophageal reflux, gastroparesis:\nAdult:Oral or IM, or slow IV injection: 10 mg 3 times daily;\nyoung adult: 15 - 19 years (under 60 Kg) 5 mg 3 times daily;\nChild:Oral, or IM, or slow IV injection: up to 1 year (up to 10\nKg) 1 mg twice daily, 1 - 3 years (10-14 Kg) 1 mg 2 - 3 times\ndaily, 3 - 5 years (15 - 19 Kg) 2 mg 2 - 3 times daily, 5 - 9 years\n(20-28 Kg.) 2.5 mg 3 times daily, 9 - 14 years (30 Kg and over)\n5 mg 3 times daily. (Usual maximum 500 micrograms/Kg daily,\nparticularly for children and young adults); Pre-medication:\nAdult,by slow I.V., 10 mg as a single dose.\nAid to gastrointestinal intubation, Orally, or IM or by Slow\nintravenous injection: Adult: 10 - 20 mg as a single dose 5 - 10\nminutes before examination; Young Adult (15 - 19 years)\n10mg; Child under 3 years 1 mg, 3 - 5 years 2 mg, 5 - 9 years\n2.5 mg, 9 - 14 years 5 mg.', 'at room temperature, protect from light.'),
(533, 575, 'nausea and vomiting in gastrointestinal disorders\nand treatment with cytotoxics or radiotherapy; gastro-\noesophageal reflux; gastroparesis; premedication and\npostoperatively; aid to gastrointestinal intubation; nausea and\nvomiting in migraine', 'elderly, children and young patients are at increased\nrisk of extrapyramidal reactions; hepatic and renal impairment;\nmay mask underlying disorders such as cerebral irritation, avoid\nfor 3 - 4 days after gastrointestinal surgery; pregnancy; breast\nfeeding; parkinson disease; depression; porphyria; patients\nshould be warned that the drug may impair their ability to\nperform activities requiring mental alertness or physical\ncoordination.', 'convulsive disorders, gastrointestinal\nhemorrhage,\nmechanical\nobstruction\nor\nperforation;\npheochromocytoma; 3â€“4 days after gastrointestinal surgery;\nhypersensitivity to the medicine.', 'alcohol, barbiturates, CNS depressants;\nphenothiazines and butyrophenones, lithium, antidepressants,\nantiepileptics, and sympathomimetics; antimuscarinic agents\nand opioid analgesics; digoxin, aspirin or paracetamol,\nsuxamethonium, bromocriptine.', 'extrapyramidal symptoms (especially in children\nand young adults), tardive dyskinesia on prolonged use;\nhyperprolactinaemia; drowsiness, restlessness, dizziness,\nheadache, diarrhoea, depression, hypotension and hypertension;\nrarely, neuroleptic malignant syndrome; cardiac conduction\nabnormalities following IV administration.', 'Nausea and vomiting, gastro-\noesophageal reflux, gastroparesis:\nAdult:Oral or IM, or slow IV injection: 10 mg 3 times daily;\nyoung adult: 15 - 19 years (under 60 Kg) 5 mg 3 times daily;\nChild:Oral, or IM, or slow IV injection: up to 1 year (up to 10\nKg) 1 mg twice daily, 1 - 3 years (10-14 Kg) 1 mg 2 - 3 times\ndaily, 3 - 5 years (15 - 19 Kg) 2 mg 2 - 3 times daily, 5 - 9 years\n(20-28 Kg.) 2.5 mg 3 times daily, 9 - 14 years (30 Kg and over)\n5 mg 3 times daily. (Usual maximum 500 micrograms/Kg daily,\nparticularly for children and young adults); Pre-medication:\nAdult,by slow I.V., 10 mg as a single dose.\nAid to gastrointestinal intubation, Orally, or IM or by Slow\nintravenous injection: Adult: 10 - 20 mg as a single dose 5 - 10\nminutes before examination; Young Adult (15 - 19 years)\n10mg; Child under 3 years 1 mg, 3 - 5 years 2 mg, 5 - 9 years\n2.5 mg, 9 - 14 years 5 mg.', 'at room temperature, protect from light.'),
(534, 576, 'nausea and vomiting in gastrointestinal disorders\nand treatment with cytotoxics or radiotherapy; gastro-\noesophageal reflux; gastroparesis; premedication and\npostoperatively; aid to gastrointestinal intubation; nausea and\nvomiting in migraine', 'elderly, children and young patients are at increased\nrisk of extrapyramidal reactions; hepatic and renal impairment;\nmay mask underlying disorders such as cerebral irritation, avoid\nfor 3 - 4 days after gastrointestinal surgery; pregnancy; breast\nfeeding; parkinson disease; depression; porphyria; patients\nshould be warned that the drug may impair their ability to\nperform activities requiring mental alertness or physical\ncoordination.', 'convulsive disorders, gastrointestinal\nhemorrhage,\nmechanical\nobstruction\nor\nperforation;\npheochromocytoma; 3â€“4 days after gastrointestinal surgery;\nhypersensitivity to the medicine.', 'alcohol, barbiturates, CNS depressants;\nphenothiazines and butyrophenones, lithium, antidepressants,\nantiepileptics, and sympathomimetics; antimuscarinic agents\nand opioid analgesics; digoxin, aspirin or paracetamol,\nsuxamethonium, bromocriptine.', 'extrapyramidal symptoms (especially in children\nand young adults), tardive dyskinesia on prolonged use;\nhyperprolactinaemia; drowsiness, restlessness, dizziness,\nheadache, diarrhoea, depression, hypotension and hypertension;\nrarely, neuroleptic malignant syndrome; cardiac conduction\nabnormalities following IV administration.', 'Nausea and vomiting, gastro-\noesophageal reflux, gastroparesis:\nAdult:Oral or IM, or slow IV injection: 10 mg 3 times daily;\nyoung adult: 15 - 19 years (under 60 Kg) 5 mg 3 times daily;\nChild:Oral, or IM, or slow IV injection: up to 1 year (up to 10\nKg) 1 mg twice daily, 1 - 3 years (10-14 Kg) 1 mg 2 - 3 times\ndaily, 3 - 5 years (15 - 19 Kg) 2 mg 2 - 3 times daily, 5 - 9 years\n(20-28 Kg.) 2.5 mg 3 times daily, 9 - 14 years (30 Kg and over)\n5 mg 3 times daily. (Usual maximum 500 micrograms/Kg daily,\nparticularly for children and young adults); Pre-medication:\nAdult,by slow I.V., 10 mg as a single dose.\nAid to gastrointestinal intubation, Orally, or IM or by Slow\nintravenous injection: Adult: 10 - 20 mg as a single dose 5 - 10\nminutes before examination; Young Adult (15 - 19 years)\n10mg; Child under 3 years 1 mg, 3 - 5 years 2 mg, 5 - 9 years\n2.5 mg, 9 - 14 years 5 mg.', 'at room temperature, protect from light.'),
(535, 577, 'For the prevention of nausea and vomiting\nassociated with moderately-to highly emetogenic cancer\nchemotherapy, radiotherapy in patients receiving total body\nirradiation or fractions to the abdomen and postoperation. Also\nused for the treatment of postoperative nausea and vomiting', 'Avoid concomitant use of medicinesthat prolong QT\ninterval; sub acute intestinal obstruction; adenotonsillar\nsurgery,In patients with cardiac rhythm or conduction\ndisturbances, in patients treated with anti-arrhythmic agents or\nbeta-adrenergic blocking agents and in patients with significant\nelectrolyte disturbance, in patients with hepatic impairment,\npregnancy ,breast feeding.', 'Hypersensitivity to medicine , other\nselective 5-HT3 antagonists, or any component of the\nformulation', 'Apomorphine, CYP3A4-inducers (such as\naminoglutethimide, carbamazepine, nafcillin, nevirapine,\nPhenobarbital, phenytoin and rifampicin), tramadol', 'Constipation; headache; flushing; injection site-\nreactions; less commonly hiccups, hypotension, bradycardia,\nchest pain, arrhythmias, movement disorders, seizures; on\nintravenous administration, rarely dizziness, transient visual\ndisturbances (very rarely transient blindness).', 'Moderately emetogenic\nchemotherapy or radiotherapy, Adults over 18 years, by\nmouth, 8 mg 1â€“2 hours before treatment or by intramuscular\ninjection or slow intravenous injection, 8 mg immediately\nbefore treatment then by mouth, 8 mg every 12 hours for up to 5\ndays or by rectum, 16 mg daily for up to 5 days. Severely\nemetogenic chemotherapy: ADULT over 18 years, by\nintramuscular injection or slow intravenous injection, 8 mg\nimmediately before treatment, where necessary followed by 2\nfurther doses of 8 mg at intervals of 2â€“4 hours (or followed by\n1 mg/hour by continuous intravenous infusion for up to 24\nhours) then by mouth, 8 mg every 12 hours for up to 5 days or\nby rectum, 16 mg daily for up to 5 days; Alternatively, by\nintravenous infusion over at least 15 minutes, 32 mg\nimmediately before treatment or by rectum, 16 mg 1â€“2 hours\nbefore treatment then by mouth, 8 mg every 12 hours for up to 5\ndays or by rectum, 16 mg daily for up to 5 days. Chemotherapy-\ninduced nausea and vomiting: CHILD 6 monthsâ€“18 years: by\nintravenous infusion over 15 minutes, 5 mg/m2 (max. 8 mg)\nimmediately before chemotherapy, then for body-surface area\nless than 0.6 m2 2 mg by mouth every 12 hours for up to 5 days;\nfor body-surface area 0.6 m2 or greater 4 mg by mouth every 12\nhours for up to 5 days; max. total daily dose 32 mg;\nalternatively, by intravenous infusion over 15 minutes,\n150 micrograms/kg (max. 8 mg) immediately before chemotherapy repeated at intervals of 4 hours for 2 further\ndoses, then for body-weight 10 kg or less 2 mg by mouth every\n12 hours for up to 5 days; for body-weight over 10 kg 4 mg by\nmouth every 12 hours for up to 5 days; maximum total daily\ndose 32 mg. Prevention of postoperative nausea and vomiting:\nby mouth, 16 mg 1 hour before anaesthesia or 8 mg 1 hour\nbefore anaesthesia followed by 8 mg at intervals of 8 hours for\n2 further doses; alternatively, by intramuscular or slow\nintravenous injection, 4 mg at induction of anaesthesia; Child1\nmonthâ€“18 years: by slow intravenous injection over at least 30\nseconds, 100 micrograms/kg (max. 4 mg) before, during, or\nafter induction of anaesthesia. Treatment of postoperative\nnausea and vomiting: by intramuscular or slow intravenous\ninjection, 4 mg; Child 1 monthâ€“18 years, by slow IV injection\nover at least 30 seconds, 100 micrograms/kg (max. 4 mg)', 'store between 2 and 30 0c'),
(536, 578, 'control of nausea, vomiting, and vertigo of various\ncauses, as a sedative and hypnotic, and as a common ingredient\nof cough and cold preparations; also see notes above', 'As for under Meclizine Hydrochloride, intravenous\ninjection of promethazine hydrochloride must be given slowly\nand extreme care must be taken; should not be given by\nsubcutaneous injection, avoid in porphyria.', 'patients\nwho\nhave\nexhibited\nhypersensitivity to the medicine; also in those who have\nreceived large doses of CNS depressants and/or in those who\nare comatose, in epileptic seizures.', 'As for meclizine hydrochloride;\nepinephrine, extrapyramidal reaction causing medications,\nlevodopa, metrizamide and monoamine oxidase (MAO)\ninhibitors including furazolidone, procarbazine, and selegiline.', 'see under Meclizine Hydrochloride, and blood\ndyscrasias, sedative effect is more pronounced.', 'Antiemetic:Oral: Adult: 25 mg\ninitially, then 10 to 25 mg every 4 - 6 hours as needed. Child\n(>2 years of age): 0.25 to 0.5 mg per Kg of body weight every 4\nto 6 hours or 10 to 25 mg every four to six hours as needed. IM\nor IV: Adult: 12.5 to 25 mg every 4 hours as needed. Child (>\n2 years of age): 0.25 to 0.5 mg per Kg of body weight every 4 to\n6 hours as needed. Rectal: Adult: 25mg initially, then 12.5 to\n25mg every 4 to 6 hours as needed. Child (> 2 years of age):\n0.25 to 0.5mg per kg of body weight, or 12.5 to 25mg every 4 to\n6 hours as needed.\nNote: For motion sickness, the initial 25 mg dose should be taken one\nhalf to one hour before travel, and the dose repeated 8 - 12 hours\nlater, if necessary.\nAntivertigo agent: Oral: Adult: 25mg 2 times a day as needed.\nChild (> 2 years of age): 0.5mg to 1mg per kg of body weight\nor 10 to 25mg 2 times a day as needed.\nRectal: Adult: 25mg 2 times a day as needed. Child (> 2\nyears of age): 0.5mg per kg of body weight, or 12.5 to 25mg 2\ntimes a day as needed.', 'Suppositories: store between 2 and 8oc, in a tight, light\n-resistant container.Tablet & Injection - at room temperature\nprotect from light and from freezing.'),
(537, 579, 'control of nausea, vomiting, and vertigo of various\ncauses, as a sedative and hypnotic, and as a common ingredient\nof cough and cold preparations; also see notes above', 'As for under Meclizine Hydrochloride, intravenous\ninjection of promethazine hydrochloride must be given slowly\nand extreme care must be taken; should not be given by\nsubcutaneous injection, avoid in porphyria.', 'patients\nwho\nhave\nexhibited\nhypersensitivity to the medicine; also in those who have\nreceived large doses of CNS depressants and/or in those who\nare comatose, in epileptic seizures.', 'As for meclizine hydrochloride;\nepinephrine, extrapyramidal reaction causing medications,\nlevodopa, metrizamide and monoamine oxidase (MAO)\ninhibitors including furazolidone, procarbazine, and selegiline.', 'see under Meclizine Hydrochloride, and blood\ndyscrasias, sedative effect is more pronounced.', 'Antiemetic:Oral: Adult: 25 mg\ninitially, then 10 to 25 mg every 4 - 6 hours as needed. Child\n(>2 years of age): 0.25 to 0.5 mg per Kg of body weight every 4\nto 6 hours or 10 to 25 mg every four to six hours as needed. IM\nor IV: Adult: 12.5 to 25 mg every 4 hours as needed. Child (>\n2 years of age): 0.25 to 0.5 mg per Kg of body weight every 4 to\n6 hours as needed. Rectal: Adult: 25mg initially, then 12.5 to\n25mg every 4 to 6 hours as needed. Child (> 2 years of age):\n0.25 to 0.5mg per kg of body weight, or 12.5 to 25mg every 4 to\n6 hours as needed.\nNote: For motion sickness, the initial 25 mg dose should be taken one\nhalf to one hour before travel, and the dose repeated 8 - 12 hours\nlater, if necessary.\nAntivertigo agent: Oral: Adult: 25mg 2 times a day as needed.\nChild (> 2 years of age): 0.5mg to 1mg per kg of body weight\nor 10 to 25mg 2 times a day as needed.\nRectal: Adult: 25mg 2 times a day as needed. Child (> 2\nyears of age): 0.5mg per kg of body weight, or 12.5 to 25mg 2\ntimes a day as needed.', 'Suppositories: store between 2 and 8oc, in a tight, light\n-resistant container.Tablet & Injection - at room temperature\nprotect from light and from freezing.'),
(538, 580, 'control of nausea, vomiting, and vertigo of various\ncauses, as a sedative and hypnotic, and as a common ingredient\nof cough and cold preparations; also see notes above', 'As for under Meclizine Hydrochloride, intravenous\ninjection of promethazine hydrochloride must be given slowly\nand extreme care must be taken; should not be given by\nsubcutaneous injection, avoid in porphyria.', 'patients\nwho\nhave\nexhibited\nhypersensitivity to the medicine; also in those who have\nreceived large doses of CNS depressants and/or in those who\nare comatose, in epileptic seizures.', 'As for meclizine hydrochloride;\nepinephrine, extrapyramidal reaction causing medications,\nlevodopa, metrizamide and monoamine oxidase (MAO)\ninhibitors including furazolidone, procarbazine, and selegiline.', 'see under Meclizine Hydrochloride, and blood\ndyscrasias, sedative effect is more pronounced.', 'Antiemetic:Oral: Adult: 25 mg\ninitially, then 10 to 25 mg every 4 - 6 hours as needed. Child\n(>2 years of age): 0.25 to 0.5 mg per Kg of body weight every 4\nto 6 hours or 10 to 25 mg every four to six hours as needed. IM\nor IV: Adult: 12.5 to 25 mg every 4 hours as needed. Child (>\n2 years of age): 0.25 to 0.5 mg per Kg of body weight every 4 to\n6 hours as needed. Rectal: Adult: 25mg initially, then 12.5 to\n25mg every 4 to 6 hours as needed. Child (> 2 years of age):\n0.25 to 0.5mg per kg of body weight, or 12.5 to 25mg every 4 to\n6 hours as needed.\nNote: For motion sickness, the initial 25 mg dose should be taken one\nhalf to one hour before travel, and the dose repeated 8 - 12 hours\nlater, if necessary.\nAntivertigo agent: Oral: Adult: 25mg 2 times a day as needed.\nChild (> 2 years of age): 0.5mg to 1mg per kg of body weight\nor 10 to 25mg 2 times a day as needed.\nRectal: Adult: 25mg 2 times a day as needed. Child (> 2\nyears of age): 0.5mg per kg of body weight, or 12.5 to 25mg 2\ntimes a day as needed.', 'Suppositories: store between 2 and 8oc, in a tight, light\n-resistant container.Tablet & Injection - at room temperature\nprotect from light and from freezing.'),
(539, 581, 'control of nausea, vomiting, and vertigo of various\ncauses, as a sedative and hypnotic, and as a common ingredient\nof cough and cold preparations; also see notes above', 'As for under Meclizine Hydrochloride, intravenous\ninjection of promethazine hydrochloride must be given slowly\nand extreme care must be taken; should not be given by\nsubcutaneous injection, avoid in porphyria.', 'patients\nwho\nhave\nexhibited\nhypersensitivity to the medicine; also in those who have\nreceived large doses of CNS depressants and/or in those who\nare comatose, in epileptic seizures.', 'As for meclizine hydrochloride;\nepinephrine, extrapyramidal reaction causing medications,\nlevodopa, metrizamide and monoamine oxidase (MAO)\ninhibitors including furazolidone, procarbazine, and selegiline.', 'see under Meclizine Hydrochloride, and blood\ndyscrasias, sedative effect is more pronounced.', 'Antiemetic:Oral: Adult: 25 mg\ninitially, then 10 to 25 mg every 4 - 6 hours as needed. Child\n(>2 years of age): 0.25 to 0.5 mg per Kg of body weight every 4\nto 6 hours or 10 to 25 mg every four to six hours as needed. IM\nor IV: Adult: 12.5 to 25 mg every 4 hours as needed. Child (>\n2 years of age): 0.25 to 0.5 mg per Kg of body weight every 4 to\n6 hours as needed. Rectal: Adult: 25mg initially, then 12.5 to\n25mg every 4 to 6 hours as needed. Child (> 2 years of age):\n0.25 to 0.5mg per kg of body weight, or 12.5 to 25mg every 4 to\n6 hours as needed.\nNote: For motion sickness, the initial 25 mg dose should be taken one\nhalf to one hour before travel, and the dose repeated 8 - 12 hours\nlater, if necessary.\nAntivertigo agent: Oral: Adult: 25mg 2 times a day as needed.\nChild (> 2 years of age): 0.5mg to 1mg per kg of body weight\nor 10 to 25mg 2 times a day as needed.\nRectal: Adult: 25mg 2 times a day as needed. Child (> 2\nyears of age): 0.5mg per kg of body weight, or 12.5 to 25mg 2\ntimes a day as needed.', 'Suppositories: store between 2 and 8oc, in a tight, light\n-resistant container.Tablet & Injection - at room temperature\nprotect from light and from freezing.'),
(540, 582, 'for the control of nausea and vomiting associated\nwith surgical procedures and cancer therapy', 'as for Meclizine Hydrochloride', 'as for Meclizine Hydrochloride', 'as for Meclizine Hydrochloride', 'as for Meclizine Hydrochloride', 'Adult:Oral, Rectal,IM, 10mg 1-3\ntimes a day. Child: Safety and efficacy has not been\nestablished.', 'protect from light. It should be stored in tight, light-\nresistant container at room temperature.'),
(541, 583, 'for the control of nausea and vomiting associated\nwith surgical procedures and cancer therapy', 'as for Meclizine Hydrochloride', 'as for Meclizine Hydrochloride', 'as for Meclizine Hydrochloride', 'as for Meclizine Hydrochloride', 'Adult:Oral, Rectal,IM, 10mg 1-3\ntimes a day. Child: Safety and efficacy has not been\nestablished.', 'protect from light. It should be stored in tight, light-\nresistant container at room temperature.'),
(542, 584, 'for the control of nausea and vomiting associated\nwith surgical procedures and cancer therapy', 'as for Meclizine Hydrochloride', 'as for Meclizine Hydrochloride', 'as for Meclizine Hydrochloride', 'as for Meclizine Hydrochloride', 'Adult:Oral, Rectal,IM, 10mg 1-3\ntimes a day. Child: Safety and efficacy has not been\nestablished.', 'protect from light. It should be stored in tight, light-\nresistant container at room temperature.'),
(543, 585, 'constipation and for bowel evacuation.', 'inflammatory bowel disease, the suppositories should\nbe used with caution in patients with rectal fissures or ulcerated\nhaemorrhoids; it should be preferably avoided in children. See\nalso notes above.', 'appendicitis, rectal bleeding, congestive\nheart failure, hypertension, diabetes mellitus, intestinal\nobstruction or undiagnosed abdominal symptoms. See also notes\nabove.', '', 'abdominal discomfort (such as colic or cramp);\ngripping (tablets); local irritation (suppositories). Diarrhoa with\nexcessive loss of water and electrolytes may occur on prolonged\nuse. See also notes above.', 'Oral:Adult and Child (>12 years):\n5-15mg daily as a single dose and up to 30mg when complete\nevacuation of bowel is required. Child (> 6 years): 5-10mg or\n0.3 mg/kg daily as a single dose at bedtime or before breakfast.\nRectal: Adult and Child (>12 years): 10mg daily as a single dose. Child 2-11 years: 5-10mg daily given as a single dose.\nChild (< 2 years of age): 5mg daily as a single dose.\nNote: It is usually effective within 6 to 12 hours following oral\nadministration and within 15 to 60 minutes following rectal\nadministration. Oral bisacodyl should be administered the evening\nbefore a morning bowl-movement is desired. Swallow the enteric-\ncoated bisacodyl whole and not crushed to avoid gastric irritation.\nTake each dose with a full glass of water. Rectal bisacodyl\nsuppositories and enemas may be administered at the time a bowl\nmovement is desired.', 'at room temperature in a well-closed container.'),
(544, 586, 'constipation and for bowel evacuation.', 'inflammatory bowel disease, the suppositories should\nbe used with caution in patients with rectal fissures or ulcerated\nhaemorrhoids; it should be preferably avoided in children. See\nalso notes above.', 'appendicitis, rectal bleeding, congestive\nheart failure, hypertension, diabetes mellitus, intestinal\nobstruction or undiagnosed abdominal symptoms. See also notes\nabove.', '', 'abdominal discomfort (such as colic or cramp);\ngripping (tablets); local irritation (suppositories). Diarrhoa with\nexcessive loss of water and electrolytes may occur on prolonged\nuse. See also notes above.', 'Oral:Adult and Child (>12 years):\n5-15mg daily as a single dose and up to 30mg when complete\nevacuation of bowel is required. Child (> 6 years): 5-10mg or\n0.3 mg/kg daily as a single dose at bedtime or before breakfast.\nRectal: Adult and Child (>12 years): 10mg daily as a single dose. Child 2-11 years: 5-10mg daily given as a single dose.\nChild (< 2 years of age): 5mg daily as a single dose.\nNote: It is usually effective within 6 to 12 hours following oral\nadministration and within 15 to 60 minutes following rectal\nadministration. Oral bisacodyl should be administered the evening\nbefore a morning bowl-movement is desired. Swallow the enteric-\ncoated bisacodyl whole and not crushed to avoid gastric irritation.\nTake each dose with a full glass of water. Rectal bisacodyl\nsuppositories and enemas may be administered at the time a bowl\nmovement is desired.', 'at room temperature in a well-closed container.'),
(545, 587, 'constipation', 'care should be taken in patients with inflammatory\nbowel disease prolonged use should be avoided, it should be\npreferably avoided in children; avoid habitual use; See also\nnotes above.', 'appendicitis, rectal bleeding, congestive\nheart failure, hypertension, diabetes mellitus, intestinal\nobstruction or undiagnosed abdominal symptoms. See also notes\nabove.', '', 'mild abdominal discomfort, diarrhoea (prolonged\nuse), reversible melanosis coli, the urine may be coloured\nyellowish brown or red and also see notes above.', 'Adult and Child (10 years and\nover): 0.3 - 1g, usually at bedtime. A laxative effect usually\noccurs 6 to 8 hours after administration. As discussed above\nsuch laxatives have a limited role in the management of\nconstipation.', 'at room temperature, in airtight container. Protect\nfrom light.'),
(546, 588, 'constipation and as an adjunct in abdominal\nradiological procedure; prophylactically in patients who should not strain during defecation, such as those with an episiotamy\nwounds, painful thrombosed hemorrhoids fissures or perianal\nabscesses, body wall and diaphragmatic hernias, anorectal\nstenosis, or postmyocardial infarction.', 'do not give with liquid paraffin.', 'symptoms of appendicitis, undiagnosed\nrectal bleeding, congestive heart failure, hypertension, intestinal\nobstruction, sensitivity to docusate.', 'potassium sparing diuretics, potassium\nsupplement, danthrol, mineral oil, phenolphthalein, aspirin.', 'undetermined allergies (skin rash), stomach and/or\nintestinal cramping.', 'Oral: Adult: up to 500 mg daily in\ndivided doses; Child over 6 months: 12.5 mg 3 times, daily; 2 â€“\n12 years: 12.5 to 25 mg 3 times daily (use pediatric oral solution\nonly).\nNote:Take each dose with a full glass of water or other liquid.', 'at room temperature, in a dry place and in a tight\ncontainer.'),
(547, 589, 'constipation and as an adjunct in abdominal\nradiological procedure; prophylactically in patients who should not strain during defecation, such as those with an episiotamy\nwounds, painful thrombosed hemorrhoids fissures or perianal\nabscesses, body wall and diaphragmatic hernias, anorectal\nstenosis, or postmyocardial infarction.', 'do not give with liquid paraffin.', 'symptoms of appendicitis, undiagnosed\nrectal bleeding, congestive heart failure, hypertension, intestinal\nobstruction, sensitivity to docusate.', 'potassium sparing diuretics, potassium\nsupplement, danthrol, mineral oil, phenolphthalein, aspirin.', 'undetermined allergies (skin rash), stomach and/or\nintestinal cramping.', 'Oral: Adult: up to 500 mg daily in\ndivided doses; Child over 6 months: 12.5 mg 3 times, daily; 2 â€“\n12 years: 12.5 to 25 mg 3 times daily (use pediatric oral solution\nonly).\nNote:Take each dose with a full glass of water or other liquid.', 'at room temperature, in a dry place and in a tight\ncontainer.'),
(548, 590, 'constipation, especially in children; see also notes\nabove.', 'avoid habitual use', 'as for bisacodyl', '', 'rectal discomfort such as irritation, burning and\npain may occur rarely.', 'Rectal: Adult: 2 â€“ 4g suppository;\nChild: 2g suppository; Infant: 1g suppository.\nNote: The suppositories should be moistened with water before\ninsertion.', 'In a cool place, in airtight containers.'),
(549, 591, 'constipation (may take up to 48 hours to act);\nhepatic encephalopathy (portal systemic encephalopathy).', 'lactose intolerance, diabetic patients (presence of\nsome free galactose and lactose)', 'as for bisacodyl; galactosaemia, intestinal\nobstruction, hypersensitivity to lactulose.', '', 'flatulence, cramps, and abdominal discomfort,\nnausea & vomiting.', 'Constipation: Oral: Initially\n10-20g (15-30ml) daily in single or 2 divided doses; increased\nup to 40g (60ml) daily if necessary. Maintenance 7 to 10g (10-\n15ml) daily.\nHepatic encephalopathy: Oral: initially 60-100g (90-150ml)\ndaily in 3-4 divided doses; doses should be adjusted after 1-2\ndays to produce 2-3 soft stools daily, or to keep the PH of the\nstool at about 5.\nChild: Constipation: Oral: under 1 year, 2.5ml; 1-5 year, 5ml; 6-\n12 years, 10ml twice daily, gradually reduced.\nStorage: in airtight container preferably at a temperature\nbetween 20c and 300c.', ''),
(550, 592, 'constipation (may take up to 48 hours to act);\nhepatic encephalopathy (portal systemic encephalopathy).', 'lactose intolerance, diabetic patients (presence of\nsome free galactose and lactose)', 'as for bisacodyl; galactosaemia, intestinal\nobstruction, hypersensitivity to lactulose.', '', 'flatulence, cramps, and abdominal discomfort,\nnausea & vomiting.', 'Constipation: Oral: Initially\n10-20g (15-30ml) daily in single or 2 divided doses; increased\nup to 40g (60ml) daily if necessary. Maintenance 7 to 10g (10-\n15ml) daily.\nHepatic encephalopathy: Oral: initially 60-100g (90-150ml)\ndaily in 3-4 divided doses; doses should be adjusted after 1-2\ndays to produce 2-3 soft stools daily, or to keep the PH of the\nstool at about 5.\nChild: Constipation: Oral: under 1 year, 2.5ml; 1-5 year, 5ml; 6-\n12 years, 10ml twice daily, gradually reduced.\nStorage: in airtight container preferably at a temperature\nbetween 20c and 300c.', ''),
(551, 593, 'constipation associated with stricture of colon', 'avoid prolonged use and caution should be taken in\nchildren, pregnant women, elderly patients; caution is also\nrecommended with bedridden patients who may develop lipid\npneumonia from aspiration of miniral oil.', 'as for bisacodyl; also colostomy, ilestomy.', 'avoid concomitant administration of the oil\nwith fat soluble vitamins (A, D, E, K), carotene, oral contraceptive,\ncumarine\nand\nindandione\nderivative\nanticoagulants', 'seepage of mineral oil that may cause soiling of the\nskin and clothing, anal irritation, pruritis, impair normal rectal\nreflex mechanism, granulomatous reaction caused by absorption\nof small quantities of liquid paraffin, lipoid pneumonia.', 'Oral: 5-20ml, when required.', 'at room temperature and protect from freezing'),
(552, 594, 'rapid bowel evacuation in preparations for rectal\nand bowel examination, and selective colon surgery; to hasten\nexcretion of poisonous substances, except acids or alkalis, from\nthe G.I.T.', 'care should be taken in patients with renal\nimpairment, hepatic impairment, in elderly and debilitated\npatients.', 'as for bisacody; acute GI conditions,\ncolostomy, ileostomy, (increased risk of electrolyte or fluid\nimbalance); dehydaration, renal impairment.', 'coumarin or indandione derivative\nanticoagulants, digitalis glycoside, chlorpromazine, sodium\npolystyrene sulfonate, and tetracycline', 'colic, cramping, diarrhea, gas formation, increased\nthirst, electrolyte imbalance (confusion, irregular heart beat,\nmuscle cramp, unusual tiredness or weakness).', 'Oral: Adult: 5 â€“ 10 gm in a\ntumberful of water preferably before breakfast (for rapid bowel\nevacuation).Child: older than 6 years of age 5 â€“ 10 gms dissolved in 120 ml\nof water.Note: take each dose with a full glass of water. Dissolve or\nmix in water or other liquid before taking.', 'at room temperature in a well-closed container.'),
(553, 595, 'see note above, adjunct in obesity.', 'see notes above: adequate fluid intake should be\nmaintained to avoid intestinal obstruction- it may be necessary\nto supervise elderly or debilitated patients or those with\nintestinal narrowing or decreased motility.', 'dysphagia, difficulty in swallowing,\nintestinal obstruction, colonic atony, faecal impaction, and\ninfective bowel disease; see also under bisacodyl.', '', 'flatulence, abdominal distensions, gastro-intestinal\nobstruction or impaction, hypersensitivity reactions reported.', 'Adult and Child 12 and older: up\nto 6 g daily given in divided doses of 0.43 - 3 g per dose. Child\n6 - 11 years of age - up to 3g daily given in divided dose of 0.45\n- 1 .5 g per dose', 'at room temperature in a well-closed container'),
(554, 596, 'Constipation, especially in diverticular disease and\nirritable bowel syndrome, and when excessive straining at\nstoolmust be avoided.', 'avoid prolonged use; adequate fluid should be taken\nto avoid intestinal obstruction. Caution on dispensing the\npowder to avoid sensitization to air born particles of psyllium.', 'see under bisacodyl; pre-existing faecal\nimpaction, intestinal obstruction or colonic atony', 'tetracyclines.', 'hypersensitivity reactions; esophageal blockage or\nintestinal impaction.', 'Oral: Adult and Child (12 years\nand older): 30gm given daily in divided doses of 2.5 to 7.5gm\nper dose; Children 6 to11 years old - 15gm daily given in\ndivided doses of 2.5-3.75gm per dose', 'at room temperature in a tight container and in a dry\nplace.'),
(555, 597, 'constipation and bowel evacuation.', 'Pregnancy, breastfeeding, see also under Cascara\nSagrada', 'see under Cascara Sagrada', '', 'see notes above.', 'Oral: Adult: 15 - 30 mg, as a\nsingle dose at bedtime. Child (over 6 years of age), one half of\nthe adult dose, and those aged 2 to 6 years are quarter the adult\ndose.\nNote: It is usually effective with in 6 to 12 hours', 'at room temperature in a dry place. Protect from\nfreezing'),
(556, 598, 'acute diarrhoea (adjunctive therapy)', 'inflammatory bowel disease; severe colitis.', 'severe hepatic disease, pseudomembranous\ncolitis and diarrhoea from infective aetiology; elderly and patients with glaucoma or prostate hypertrophy; children under\n4 years.', 'CNS depressants (alcohol, phenobarbitone,\nopioid analgesics), phenothiazines, tricyclic antidepressants,\nantimuscaranics, MAO inhibitors.', 'nausea, dizziness, drowsiness, fatigue, sensitivity\nreactions include angioedema and giant urticaria, headache,\neuphoria, respiratory and mental depression. Anticholinergic\nsymptoms such as dry mouth, fever, blurred vision; tachycardia\nand urinary retention may be produced by the atropine in the\nformulation, especially in children.', 'Oral: Adult: Diphenoxylate 5 mg 4\ntimes/day until control achieved (maximum: 20 mg/day), then\nreduce dose as needed; some patients may be controlled on\ndoses of 5 mg/day.Child: some authorities recommend that it\nshould be avoided in children under 12 years. However, in\ncertain circumstances the following doses have been used: 4 - 8\nyears, 2. 5 mg upto 3 times daily, 9 - 12 years, 2.5 mg upto 4\ntimes daily, 13 - 16 years, 5 mg upto 3 times daily.', 'store at room temperature and protect from light'),
(557, 599, 'acute and chronic diarrhoea', 'dehydration, impaired hepatic function; children and\nthe elderly.', 'pseudomembranous colitis, diarrhoea of\ninfective origin, or severe colitis from inflammatory bowel\ndisease, history of allergic reaction to loperamide, for children\nunder 2 years.', 'opioid analgesics, CNS depressants (e.g.\nalcohol)', 'Abdominal pains, nausea, constipation, dry mouth\nand blurred vision, CNS reactions such as dizziness, headache\nand fatigue, hypersensitivity reactions', 'Oral: Adult: Acute diarrhoea:\ninitially 4 mg, followed by 2 mg after each loose stool until\ndiarrhoea is controlled; maximum 16 mg/24 hours. Chronic\ndiarrhoea: usually 4 - 8 mg daily in divided doses. Child over\n2 years: initially 1 mg/12.5 kg body mass, followed by 0.5 mg\n/12.5 kg after each loose stool. Alternatively, 0.08 - 0.24\nmg/kg/day in 2 - 3 divided doses.\nNote: If no improvement has been observed after treatment with 16mg\ndaily for at least 10 days, further administration is unlikely to be of\nbenefit.', 'store at room temperature.'),
(558, 600, 'zinc deficiency or supplementation in zinc-losing\nconditions', 'acute renal failure (may accumulate), pregnancy\nbreast feeding', 'copper deficiency,high- density lipoprotein', 'Quinolone antibiotics, tetracycline\nderivatives, trientine.', 'abdominal pain, dyspepsia, nausea, vomiting,\ndiarrhea, gastric irritation, gastritis; irritability, headache,\nlethargy', 'Zinc supplements should not be\ngiven unless there is good evidence of deficiency\n(hypoproteinaemia spuriously lowers plasma-zinc\nconcentration) or in zinc-losing conditions. Zinc deficiency can\noccur as a result of inadequate diet or malabsorption; excessive\nloss of zinc can occur in trauma, burns, and protein-losing\nconditions. A zinc supplement is given until clinical\nimprovement occurs, but it may need to be continued in severe\nmalabsorption, metabolic disease or in zinc-losing states.\nadult and child over 30 kg, 1 tablet in water 1â€“3 times daily\nafter food; child under 10 kg, Â½ tablet daily; 10â€“30 kg, Â½ tablet\n1â€“3 times daily.', ''),
(559, 601, 'zinc deficiency or supplementation in zinc-losing\nconditions', 'acute renal failure (may accumulate), pregnancy\nbreast feeding', 'copper deficiency,high- density lipoprotein', 'Quinolone antibiotics, tetracycline\nderivatives, trientine.', 'abdominal pain, dyspepsia, nausea, vomiting,\ndiarrhea, gastric irritation, gastritis; irritability, headache,\nlethargy', 'Zinc supplements should not be\ngiven unless there is good evidence of deficiency\n(hypoproteinaemia spuriously lowers plasma-zinc\nconcentration) or in zinc-losing conditions. Zinc deficiency can\noccur as a result of inadequate diet or malabsorption; excessive\nloss of zinc can occur in trauma, burns, and protein-losing\nconditions. A zinc supplement is given until clinical\nimprovement occurs, but it may need to be continued in severe\nmalabsorption, metabolic disease or in zinc-losing states.\nadult and child over 30 kg, 1 tablet in water 1â€“3 times daily\nafter food; child under 10 kg, Â½ tablet daily; 10â€“30 kg, Â½ tablet\n1â€“3 times daily.', ''),
(560, 602, 'flatulence, indigestion and intestinal distention.', 'advise patients not to take other medications orally\nwithin two hours of the activated charcoal, except when\ninactivation of the medication is desired.', '', 'avoid simultaneous use of any other\nmedicineswith activated charcoal', 'vomiting, constipation, and pulmonary aspiration,\nintestinal obstruction (with multiple dose administration); it\ncolours the stool black.', 'Orally with plenty of water chew a\ntablet every 8 hours daily after meals.Note: FDA has classified\nactivated charcoal as lacking substaintial evidence of efficacy as an\nantiflatulent or digestive aid.', 'Orally with plenty of water chew a\ntablet every 8 hours daily after meals.Note: FDA has classified\nactivated charcoal as lacking substaintial evidence of efficacy as an\nantiflatulent or digestive aid.');
INSERT INTO `drugformulary` (`drugFormularyId`, `drugsId`, `indications`, `cautions`, `contraindications`, `drugInteractions`, `sideEffects`, `doseAndAdministration`, `storage`) VALUES
(561, 603, 'treatment of conditions in which retention of a gas\nmay be a problem. It may be also be used as diagnostic aid as\nanti-foaming agent during gastroscopy to enhance visualization\nand prior to radiography of bowel to reduce gas shadows', 'simethicone is not recommended for the trestment of\ninfant colic because of limited information on its safety in\ninfants and children', 'hypersensitivity to simethicone', '', 'allergic reaction/rash, hives, itching, difficulty\nbreathing, tightness in the chest, swelling of mouth, face, lips,\nor tongue', 'chewable tablet: oral, 60 to 95 mg\nfour times a day after meals and at bed time or as needed or 150\nmg three times a day after meals or as needed. Capsule: oral, 95\nor 125mg four times a day after meals and bed time or as\nneeded.Note: Dose for pediatrics must be individualized by\nphysician.', 'store between 15-30oc, unless otherwise specified by\nmanufacturer. Store in a well-closed container.'),
(562, 604, 'treatment of conditions in which retention of a gas\nmay be a problem. It may be also be used as diagnostic aid as\nanti-foaming agent during gastroscopy to enhance visualization\nand prior to radiography of bowel to reduce gas shadows', 'simethicone is not recommended for the trestment of\ninfant colic because of limited information on its safety in\ninfants and children', 'hypersensitivity to simethicone', '', 'allergic reaction/rash, hives, itching, difficulty\nbreathing, tightness in the chest, swelling of mouth, face, lips,\nor tongue', 'chewable tablet: oral, 60 to 95 mg\nfour times a day after meals and at bed time or as needed or 150\nmg three times a day after meals or as needed. Capsule: oral, 95\nor 125mg four times a day after meals and bed time or as\nneeded.Note: Dose for pediatrics must be individualized by\nphysician.', 'store between 15-30oc, unless otherwise specified by\nmanufacturer. Store in a well-closed container.'),
(563, 605, 'replacement therapy in symptomatic treatment of\nmalabsorption syndrom due to cystic fibrosis and other\nconditions associated with exocrine pancreatic insufficiency', 'fibrotic strictures in the colon with high doses,\nespecially in children, nursing women, pregnancy', 'hypersensitivity to hog protein.', 'iron, absorption may be decreased.', 'diarrhea or other transient intestinal upset,\nhyperuricosuria and hyperuricemia, hypersensitivity reactions\n(e.g. sneezing, lacrimation, rash). Retention of pancreatin\npreparations in the mouth before swallowing may cause\nirritation of the mucosa and has resulted in ulceration and\nstomatitis.', 'Adult: Oral: 1-3 tablets before,\nduring or one hour after meals, with an extra dose taken with\nany food eaten between meals.', 'store at a temperature not exceeding 15OC and in\nairtight containers.'),
(564, 606, 'to relieve anal and perianal pain, itching and\nsoreness associated with hemorrhoids, anal fissures.', 'advise patients to regulate their diet to produce soft\nstools that pass through the anus with a minimum irritation.\nPatients should be instructed to take hygienic measures after\ndefecation. Seenotes above', '', '', '', 'Rectally, wash and dry the anal area\nbefore application. Unless otherwise indicated; Ointment â€“\nApply rectally night andmorning and after defecation.\nSuppositories â€“ Insert in to the rectum night and morning and\nafter defection.', 'in a cool place.'),
(565, 607, 'to relieve anal and perianal pain, itching and\nsoreness associated with hemorrhoids, anal fissures.', 'advise patients to regulate their diet to produce soft\nstools that pass through the anus with a minimum irritation.\nPatients should be instructed to take hygienic measures after\ndefecation. Seenotes above', '', '', '', 'Rectally, wash and dry the anal area\nbefore application. Unless otherwise indicated; Ointment â€“\nApply rectally night andmorning and after defecation.\nSuppositories â€“ Insert in to the rectum night and morning and\nafter defection.', 'in a cool place.'),
(566, 608, 'sameas Bismuth Subgallate Compound, and anal\ninflammation in the absence of infection, see notes above', 'Same as Bismuth Subgallate Compound. Avoid this\npreparation in the presence of an infection in the rectal area.', 'known hypersensitivity to the preparation,\nuntreated infection.', '', 'worsening of untreated infection, and thinning of\nthe skin structure on prolonged use', 'Rectally. Wash and dry the ectal area\nbefore application. Unless otherwise indicated, Ointments â€“\nApply rectally night and morning and after defection.\nSuppositories â€“ Insert into the rectum night and morning and\nafter defection.', ' in a cool place.'),
(567, 609, 'sameas Bismuth Subgallate Compound, and anal\ninflammation in the absence of infection, see notes above', 'Same as Bismuth Subgallate Compound. Avoid this\npreparation in the presence of an infection in the rectal area.', 'known hypersensitivity to the preparation,\nuntreated infection.', '', 'worsening of untreated infection, and thinning of\nthe skin structure on prolonged use', 'Rectally. Wash and dry the ectal area\nbefore application. Unless otherwise indicated, Ointments â€“\nApply rectally night and morning and after defection.\nSuppositories â€“ Insert into the rectum night and morning and\nafter defection.', ' in a cool place.'),
(568, 610, 'for treatment of hemorrhoids. They are suitable for\noccasional short-term use after exclusion of infection, such as\nherpes simplex', '', '', '', '', 'Ointment â€“ Apply several times\ndaily, short â€“ term use; Suppositories â€“ insert 1 suppository at\nnight and after a bowel movement; short-term use only', ''),
(569, 611, 'for treatment of hemorrhoids. They are suitable for\noccasional short-term use after exclusion of infection, such as\nherpes simplex', '', '', '', '', 'Ointment â€“ Apply several times\ndaily, short â€“ term use; Suppositories â€“ insert 1 suppository at\nnight and after a bowel movement; short-term use only', ''),
(570, 612, 'for treatment of rectal Haemorrhoids', 'Severe hepatic impairment, Pregnancy, avoid during\n1st trimester, Lactation.', '', '', 'Burning sensation, mild pain, increased bowel\nmotility, rash.', 'Insert 1 suppository twice daily\nuntil discomfort is relieved, and then reduce to once daily', ''),
(571, 613, ' short term symptomatic treatment of hemorrhoids.', '', '', '', '', '', ''),
(572, 614, ' short term symptomatic treatment of hemorrhoids.', '', '', '', '', '', ''),
(573, 615, 'treatment of the functional symptoms of benign\nprostatic hyperplasia (BPH).', 'not intended for use as an antihypertensive drug.\nRenal and hepatic impairment, angina, floppy iris syndrome,\northostatic hypotension', 'Hypersensitivity to alfuzosin or any\ncomponent of the formulation; moderate or severe hepatic;\nconcurrent use with potent CYP3A4 inhibitors (eg, itraconazole,\nketoconazole, ritonavir)', 'azole antifungals, ciprofloxacin,\nclarithromycin, diclofenac, doxycycline, erythromycin, isoniazid,\npropofoll, protease inhibitors, quinidine, verapamil and other\nCYP3A4 inhibitors; aminoglutethimide, carbamazepine,\nnafcillin, nevirapine, phenobarbital, phenytoin, rifamycins, and\nother CYP3A4 inducers, alpha blockers, calcium channel\nblockers, MAO inhibitors', 'dizziness, fatigue/ weakness, headache, abdominal\npain, constipation, dyspepsia, nausea, impotence, bronchitis, and\npharyngitis, orthostatic hypotension.', 'Adult: Oral:10 mg per day.', 'store at room temperature and protect from light and\nmoisture.'),
(574, 616, 'Treatment of urinary outflow obstruction and/or\nobstructive and irritative symptoms associated with benign prostatic hyperplasia (BPH), particularly useful in patients with\ntroublesome symptoms who are unable or unwilling to undergo\ninvasive procedures, but who require rapid symptomatic relief;\ncan be used in combination with finasteride; for treatment and\nmanagement of mild to moderate hypertension.', 'Since doxazosin is alpha1-selective alpha blockers\nreduce blood pressure, patients receiving antihypertensive\ntreatment may require reduced dosage and specialist supervision.\nCaution is required in the elderly and in patients undergoing\ncataract surgery (risk of intra-operative floppy iris syndrome),\nangina, orthostatic hypotension, hepatic impair.', 'Hypersensitivity to quinazolines (prazosin,\nterazocin), doxazosin, or any component of the formulation.\nAlpha-blockers should be avoided in patients with a history of\npostural hypotension and micturition syncope', 'enhanced hypotensive effect with adrenergic\nneurone blockers, diuretics, ACE inhibitors, calcium channel\nblockers, other antihypertensive medications, sildenafil, tadalafil,\nvardenafil, NSAIDs, alcohol, aldesleuk, alprostadil, anxiolytics\nandhypnotics, baclofen,beta-blockers, hydralazine, MAOIs,\nantipsychotics, oestrogens, Corticosteroids, levodopa,\nmethyldopa.', 'Drowsiness, hypotension (notably postural\nhypotension), syncope, asthenia, dizziness, depression, headache,\ndry mouth, gastro-intestinal disturbances, oedema, blurred vision,\nrhinitis, erectile disorders, tachycardia, and palpitations.\nHypersensitivity reactions including rash, pruritus and\nangioedema', 'Initially 1 mg daily; dose may be\ndoubled at intervals of 1â€“2 weeks according to response, up to\nmaximum 8 mg daily; usual maintenance 2â€“4 mg daily. BPH: 4-8mg/day, maximum dose: 8mg/day. Hypertension: maximum\ndose: 16mg/day. Elderly: initial 0.5mg once daily\nNote: Syncope may occur usually within 90 minutes of the initial dose', 'Store in a dry place, at room temperature in a wellclosed container protected from light'),
(575, 617, 'For the treatment of symptomatic benign prostatic\nhyperplasia (BPH) in men with an enlarged prostate gland to\nimprove symptoms, and reduce the risk of acute urinary retention\nand the need for surgery.', 'Patients with large residual urine volume and/or\nseverely diminished urinary flow should be carefully monitored\nfor obstructive uropathy. Dutasteride and finasteride decrease\nserum concentration of prostate cancer markers such as prostatespecific antigen; reference values may need adjustment.\nDutasteride and finasteride are excreted in semen and use of a\ncondom is recommended if sexual partner is pregnant or likely to\nbecome pregnant. No clinical benefit has yet been demonstrated\nin patients with prostate cancer treated with dutasteride and\nfinasteride. Women of childbearing potential should avoid handling\ncrushed or broken tablets of finasteride and leaking capsules of\ndutasteride.', 'for use in women of childbearing potential;\npregnancy, children and adolescents; for patients with known\nhypersensitivity to dutasteride, other 5a-reductase inhibitors or\nany component of the preparation', ' Diltiazem, Verapamil', 'Breast tenderness or enlargement, decrease in sex\ndrive, difficulty ejaculating, and inability to have or maintain an\nerection, rash, itching, urticaria, localized edema.', 'The recommended dose dutasteride\nis 0.5 mg taken orally once a day. The capsules should be\nswallowed whole and not chewed or opened; as contact with the\ncontents may result in irritation of the oropharyngeal mucosa.\nDutasteride may be administered with or without food. Although\nearly improvement in symptoms may be seen, treatment for at\nleast six months may be necessary to assess whether a beneficial\nresponse has been achieved. No dosage adjustment is necessary\nfor subjects with renal impairment or elderly. Due to the absence\nof data in patients with hepatic impairment, no dosage\nrecommendation can be made', 'Store at room temperature; protect from moisture.'),
(576, 618, 'Finasteride is indicated for the treatment and\ncontrol of benign prostatic hyperplasia (BPH) in patients with an\nenlarged prostate to: cause regression of the enlarged prostate,\nimprove urinary flow and improve the symptoms associated with\nBPH. Reduce the incidence of acute urinary retention and the\nneed for surgery including transurethral resection of the prostate\n(TURP) and Prostatectomy.', 'See under dutasteride', 'Hypersensitivity to any component of this\nmedicine; women who are or may potentially be pregnant;\nchildren and adolescents', 'Finasteride is a synthetic analog of\ntestosterone and inhibits an intracellular enzyme responsible for\nconverting testosterone to the potent androgen 5-â€º-\ndihydrotestosterone (DHT). Although finasteride appears to\ninterfere with the activation of testosterone to a more active form,\npresumably blocking the effects of testosterone, it would be\nillogical to administer finasteride concurrently with testosterone\nor other androgens.', 'Impotence, decreased libido, ejaculation disorders,\nand breast tenderness and enlargement, testicular pain,\nhypersensitivity reactions (including lip and face swelling,\npruritus and rash); male breast cancer', 'Adult: one 5 mg tablet daily, taken\norally with or without food. Finasteride can be administered\nalone or in combination with the alpha-blocker doxazosin.\nAlthough early improvement in symptoms may be seen,\ntreatment for at least six months may be necessary to assess\nwhether a beneficial response has been achieved. Thereafter,\ntreatment should be continued long term. Clinical respose occur\nwithin 12 weeks to 6 months of initiation of therapy. Therefore,\nlong term administration is recommended for maximal response.\nNo dosage adjustment is required in the elderly or in patients\nwith varying degrees of renal insufficiency (creatinine clearances\nas low as 9 ml/min).', ''),
(577, 619, 'For treatment of benign prostatic hyperplasia and\nhypertension, hypertension associated with pheochromocytoma.', 'elderly patients, during pregnancy and breastfeeding,\nangina pectoris, narcolepsy, and in those sensitive to the\nmedicine. First dose may cause collapse due to hypotension\n(should be taken on retiring to bed); hepatic or renal function\nimpairment; advice patients not to do activities requiring\nalertness.', 'heart failure caused by mechanical\nobstruction, for example aortic or mitral valve stenosis,\npulmonary embolism, and restrictive pericardial disease.', 'nifedipine, other antihypertensive agents or\nnitrates, alcohol, beta blockers and calcium channel blockers.', 'dizziness, orthostatic hypotension, edema,\npalpitations, dry mouth, urinary incontinence, angina, dyspnea,\nand priapism, drowsiness, headache, lack of energy, and nausea.', 'Oral: Adult: 0.5 mg 2â€“3 times daily,\nthe initial dose on retiring to bed or night (to avoid collapse)\nincreased to 1 mg 2 â€“ 3 times daily after 3 â€“ 7 doses further\nincreased if necessary to maximum 20 mg daily. Child (under 7\nyears of age), initially 0.25 mg 2 â€“ 3 times a day adjusted\naccording to response. 7 to 12 years of age, initially 0.5 mg two\nor three times a day adjusted according to response.', 'at room temperature in a well-closed, light â€“ resistant\ncontainer.'),
(578, 620, 'Used in the treatment of signs and symptoms of\nbenign prostatic hyperplasia (reduction in urinary obstruction and\nrelief of associated manifestations such as hesitancy, terminal\ndribbling of urine, interrupted or weak stream, etc,).', 'see under\ndoxazosin', 'Hypersensitivity to the medicine or any\ncomponent of the formulation; in patients with a history of\npostural hypotension and micturition syncope', 'see under\ndoxazosin', 'see under\ndoxazosin', '0.4 mg PO daily 30 min after the\nmeal each day; if response is not satisfactory in 2â€“4 weeks,\ndosage may be increased to 0.8 mg PO daily 30 min after the\nmeal each day. If therapy is interrupted for any reason for several\ndays, resume dosing at 0.4 mg PO daily', 'Store at room temperature; protect from moisture.'),
(579, 621, 'is used as a short-term therapy in patients with\nintractable heart failure.Because of limited clinical experience\nwith the drug, it should be reserved in used for patients under\nclose monitoring', 'severe aortic or pulmonic valvular disease', 'gastrointestinal disturbances that may\nnecessitate withdrawal of of treatment, hypersensitivity reaction\nto the medicine. Known hypersensitivity to sulfiting agents (i.e., sulfur dioxide, potassium or sodium bisulfite, potassium or\nsodium metabisulfite, sodium sulfite)', 'diruretics (Furosemide), digitalis (digoxin)', 'arrhythmias, hypotension, thrombocytopenia,\nchest pain, fever, hepatotoxicity, and hypersensitivity.', '0.75 mg/kg IV\nbolus over 2-3 minutes followed by maintenance infusion of 5-\n10 mcg/kg/minute; IV bolus may need to be repeated in 30\nminutes.', 'See manufacturersâ€™ recommendation.'),
(580, 622, 'treatment of congestive heart failure, management\nof hypertension, left ventricular dysfunction after myocardial\ninfarction; diabetic nephrophaty.', 'impaired renal function, patient with solitary kidney,\ncollagen-vascular disease, patients receiving\nimmunosuppresants or other medicinesthat cause leukopenia or\nagranulocytosis, coronary or cerebrovascular disease, severe\nsalt/volume depletion.', 'hypersensitivity to ACE inhibitors,\nidiopathic or hereditary angioedema; known or suspected\nvenovascular disease; aortic or bilateral renal artery stenosis,\noutflow tract obstruction. ACEIs can cause injury and death to\nthe developing fetus when used in the second and third\ntrimesters. ACEIs should be discontinued as soon as possible\nonce pregnancy is detected.', 'potassium-sparing diuretics or potassium\nsupplements (ACE inhibitors are â€˜potassium-sparingâ€™ agents);\naspirin, indomethacin and propably other NSAIDs, antacids,\ndigoxin and lithium, probenecid, food decreases absorption-take\n30-60 minutes before meals', 'see notes above; slight increase in heart rate, first\ndose hypotension, dizziness, fainting; rash (maculopapular or\nurticarial), pruritus; hyperkalemia, neutropenia, proteinuria,\nincreased serum creatinine, cough, hypersensitivity reactions;\naltered taste sensation.\nNote:-In the treatment of heart failure severe first-dose\nhypotension on introduction of an ACE inhibitor is common in\npatients on loop diuretics.', 'Dosing: Adult Heart failure: Oral:\nInitial dose: 6.25-12.5 mg 3 times/day in conjunction with\ncardiac glycoside and diuretic therapy; initial dose depends\nupon patient\'s fluid/electrolyte status. Target dose: 50 mg 3\ntimes per day', 'Pediatric Hypertension: Oral: Infants: Initial: 0.15-0.3\nmg/kg/dose; titrate dose upward to maximum of 6 mg/kg/day in\n1-4 divided doses\nChildren: Initial: 0.3-0.5 mg/kg/dose; titrate upward to\nmaximum of 6 mg/kg/day in 2-4 divided doses\nOlder Children: Initial: 6.25-12.5 mg/dose every 12-24 hours;\ntitrate upward to maximum of 6 mg/kg/day\nAdolescents: Initial: 12.5-25 mg/dose; titrate to a maximum of\n450 mg per day\nDosing: Renal Impairment, Adults: Clcr 10-50 mL/minute:\nAdminister at 75% of normal dose every 12-18 hours. Clcr<10\nmL/minute: Administer at 50% of normal dose every 24 hours.\nProphylaxis after myocardial infarction (in clinically stable\npatients): Oral:Adult: initially 6.25 mg gradually increased\nover several weeks to 150 mg daily in divided doses.'),
(581, 623, 'Treatment of mild-to-moderate (or stage C as\nrecommended by the ACCF/AHA) heart failure (HF); atrial\nfibrillation (rate-control). In treatment of atrial fibrillation (AF),\nuse is not considered first-line unless AF coexistent with heart\nfailure or in sedentary patients', 'patients with recent myocardial infarction, sick sinus\nsyndrome, hyporthyroidism, severe pulmonary disease; elderly\npatients and in patients with renal function impairment where\ndosage adjustment is necessary; breast-feeding; electrolyte\ndisturbances; Avoid rapid intravenous administration (nausea\nand risk of arrhythmias)', 'amiodarone, beta-adrenergic blocking\nagents, (including atenolol, carvedilol, metoprolol and\npropranolol), calcium channel blocking agents, especially\nverapamil, potassium-depleting diuretics (such as bumetanide,\nethacrynic acid, furosemide, indapamide, mannitol, or thiazide),\npropafenone, quinidine or quinine, sympathomimetics. Oral\naminoglycosides may decrease the serum concentration of\ndigoxin.', 'amiodarone, beta-adrenergic blocking\nagents, (including atenolol, carvedilol, metoprolol and\npropranolol), calcium channel blocking agents, especially\nverapamil, potassium-depleting diuretics (such as bumetanide,\nethacrynic acid, furosemide, indapamide, mannitol, or thiazide),\npropafenone, quinidine or quinine, sympathomimetics. Oral\naminoglycosides may decrease the serum concentration of\ndigoxin.', 'anorexia, nausea, vomiting, lower stomach pain,\ndiarrhea, weakness, blurred or yellow vision, drowsiness,\nconfusion, mental depression, headache and hallucinations,\narrythmias, hypotension, AV block.', 'When changing from oral (tablets\nor liquid) or I.M. to I.V. therapy, dosage should be reduced by\n20% to 25%. Atrial fibrillation: (rate control) in patients with\nheart failure: Loading dose: I.V.: 0.25 mg every 2 hours, up to\n1.5 mg within 24 hours; for nonacute situations, may administer\n0.5 mg orally once daily for 2 days followed by oral\nmaintenance dose. Maintenance dose: I.V., Oral: 0.125-0.375\nmg once daily. Heart failure: Daily maintenance dose (Note:\nLoading dose not recommended): Oral: 0.125-0.25 mg once\ndaily; higher daily doses (up to 0.5 mg/day) are rarely\nnecessary. If patient is >70 years of age, has impaired renal\nfunction, or has a low lean body mass, low doses (eg, 0.125 mg\ndaily or every other day) should be used. Emergency control of\natrial fibrillation, IV infusion over at least 2 hours: Adult:\nInitial total digitalizing dose 0.75â€“1.5 mg (I.V., I.M.: 0.5-1 mg\nDaily maintenance dose: Oral: 0.125-0.5 mg once daily (I.V.,\nI.M.: 0.1-0.4 mg once daily. Note: I.M. not preferred due to severe\ninjection site pain.Pediatric: Atrial dysrhythmias (rate control),\nheart failure: When changing from oral (tablets or liquid) or\nI.M. to I.V. therapy, dosage should be reduced by 20% to 25%.\nSee table below.', 'At room temperature in a tight container, protect from\nfreezing'),
(582, 624, 'Treatment of mild-to-moderate (or stage C as\nrecommended by the ACCF/AHA) heart failure (HF); atrial\nfibrillation (rate-control). In treatment of atrial fibrillation (AF),\nuse is not considered first-line unless AF coexistent with heart\nfailure or in sedentary patients', 'patients with recent myocardial infarction, sick sinus\nsyndrome, hyporthyroidism, severe pulmonary disease; elderly\npatients and in patients with renal function impairment where\ndosage adjustment is necessary; breast-feeding; electrolyte\ndisturbances; Avoid rapid intravenous administration (nausea\nand risk of arrhythmias)', 'amiodarone, beta-adrenergic blocking\nagents, (including atenolol, carvedilol, metoprolol and\npropranolol), calcium channel blocking agents, especially\nverapamil, potassium-depleting diuretics (such as bumetanide,\nethacrynic acid, furosemide, indapamide, mannitol, or thiazide),\npropafenone, quinidine or quinine, sympathomimetics. Oral\naminoglycosides may decrease the serum concentration of\ndigoxin.', 'amiodarone, beta-adrenergic blocking\nagents, (including atenolol, carvedilol, metoprolol and\npropranolol), calcium channel blocking agents, especially\nverapamil, potassium-depleting diuretics (such as bumetanide,\nethacrynic acid, furosemide, indapamide, mannitol, or thiazide),\npropafenone, quinidine or quinine, sympathomimetics. Oral\naminoglycosides may decrease the serum concentration of\ndigoxin.', 'anorexia, nausea, vomiting, lower stomach pain,\ndiarrhea, weakness, blurred or yellow vision, drowsiness,\nconfusion, mental depression, headache and hallucinations,\narrythmias, hypotension, AV block.', 'When changing from oral (tablets\nor liquid) or I.M. to I.V. therapy, dosage should be reduced by\n20% to 25%. Atrial fibrillation: (rate control) in patients with\nheart failure: Loading dose: I.V.: 0.25 mg every 2 hours, up to\n1.5 mg within 24 hours; for nonacute situations, may administer\n0.5 mg orally once daily for 2 days followed by oral\nmaintenance dose. Maintenance dose: I.V., Oral: 0.125-0.375\nmg once daily. Heart failure: Daily maintenance dose (Note:\nLoading dose not recommended): Oral: 0.125-0.25 mg once\ndaily; higher daily doses (up to 0.5 mg/day) are rarely\nnecessary. If patient is >70 years of age, has impaired renal\nfunction, or has a low lean body mass, low doses (eg, 0.125 mg\ndaily or every other day) should be used. Emergency control of\natrial fibrillation, IV infusion over at least 2 hours: Adult:\nInitial total digitalizing dose 0.75â€“1.5 mg (I.V., I.M.: 0.5-1 mg\nDaily maintenance dose: Oral: 0.125-0.5 mg once daily (I.V.,\nI.M.: 0.1-0.4 mg once daily. Note: I.M. not preferred due to severe\ninjection site pain.Pediatric: Atrial dysrhythmias (rate control),\nheart failure: When changing from oral (tablets or liquid) or\nI.M. to I.V. therapy, dosage should be reduced by 20% to 25%.\nSee table below.', 'At room temperature in a tight container, protect from\nfreezing'),
(583, 625, 'Treatment of mild-to-moderate (or stage C as\nrecommended by the ACCF/AHA) heart failure (HF); atrial\nfibrillation (rate-control). In treatment of atrial fibrillation (AF),\nuse is not considered first-line unless AF coexistent with heart\nfailure or in sedentary patients', 'patients with recent myocardial infarction, sick sinus\nsyndrome, hyporthyroidism, severe pulmonary disease; elderly\npatients and in patients with renal function impairment where\ndosage adjustment is necessary; breast-feeding; electrolyte\ndisturbances; Avoid rapid intravenous administration (nausea\nand risk of arrhythmias)', 'amiodarone, beta-adrenergic blocking\nagents, (including atenolol, carvedilol, metoprolol and\npropranolol), calcium channel blocking agents, especially\nverapamil, potassium-depleting diuretics (such as bumetanide,\nethacrynic acid, furosemide, indapamide, mannitol, or thiazide),\npropafenone, quinidine or quinine, sympathomimetics. Oral\naminoglycosides may decrease the serum concentration of\ndigoxin.', 'amiodarone, beta-adrenergic blocking\nagents, (including atenolol, carvedilol, metoprolol and\npropranolol), calcium channel blocking agents, especially\nverapamil, potassium-depleting diuretics (such as bumetanide,\nethacrynic acid, furosemide, indapamide, mannitol, or thiazide),\npropafenone, quinidine or quinine, sympathomimetics. Oral\naminoglycosides may decrease the serum concentration of\ndigoxin.', 'anorexia, nausea, vomiting, lower stomach pain,\ndiarrhea, weakness, blurred or yellow vision, drowsiness,\nconfusion, mental depression, headache and hallucinations,\narrythmias, hypotension, AV block.', 'When changing from oral (tablets\nor liquid) or I.M. to I.V. therapy, dosage should be reduced by\n20% to 25%. Atrial fibrillation: (rate control) in patients with\nheart failure: Loading dose: I.V.: 0.25 mg every 2 hours, up to\n1.5 mg within 24 hours; for nonacute situations, may administer\n0.5 mg orally once daily for 2 days followed by oral\nmaintenance dose. Maintenance dose: I.V., Oral: 0.125-0.375\nmg once daily. Heart failure: Daily maintenance dose (Note:\nLoading dose not recommended): Oral: 0.125-0.25 mg once\ndaily; higher daily doses (up to 0.5 mg/day) are rarely\nnecessary. If patient is >70 years of age, has impaired renal\nfunction, or has a low lean body mass, low doses (eg, 0.125 mg\ndaily or every other day) should be used. Emergency control of\natrial fibrillation, IV infusion over at least 2 hours: Adult:\nInitial total digitalizing dose 0.75â€“1.5 mg (I.V., I.M.: 0.5-1 mg\nDaily maintenance dose: Oral: 0.125-0.5 mg once daily (I.V.,\nI.M.: 0.1-0.4 mg once daily. Note: I.M. not preferred due to severe\ninjection site pain.Pediatric: Atrial dysrhythmias (rate control),\nheart failure: When changing from oral (tablets or liquid) or\nI.M. to I.V. therapy, dosage should be reduced by 20% to 25%.\nSee table below.', 'At room temperature in a tight container, protect from\nfreezing'),
(584, 626, 'Treatment of hypertension; treatment of\nsymptomatic heart failure; treatment of asymptomatic left\nventricular dysfunction. To delay the progression of\nnephropathy and reduce risks of cardiovascular events in\nhypertensive patients with type 1 or 2 diabetes mellitus;\nhypertensive crisis, diabetic nephropathy, hypertension\nsecondary to scleroderma renal crisis, diagnosis of\naldosteronism, idiopathic edema, Bartter\'s syndrome,\npostmyocardial infarction for prevention of ventricular failure', 'see under captopril and notes above', 'see under captopril and notes above', 'see under captopril and notes above', 'see under captopril and notes above', 'Adult: Oral: Congestive heart\nfailure: Oral: Initial: 2.5 mg once or twice daily (usual range:\n5-40 mg/day in 2 divided doses); titrate slowly at 1- to 2-week\nintervals. Target dose: 10-20 mg twice daily.', 'See manufacturerâ€™s recommendation'),
(585, 627, 'see under Enalapril maleate', 'see\ncaptopril above and hydrochlorothiazide.', 'see\ncaptopril above and hydrochlorothiazide.', 'see\ncaptopril above and hydrochlorothiazide.', 'see notes above; chest pain, cholecystitis or\npancreatitis, hepatic function impairment, hyperuricemia or\ngout, neutropenia or agranulocytosis, thrombocytopenia, and\nelectrolyte imbalance.', 'Oral: Congestive heart failure:\nAdult: 1 tablet once or twice per day, as determined by\nindividual titration with the component agents, for a maximum\nof 20 mg of Enalapril and 50 mg of Hydrochlorothiazide.\nChild: as determined by individual titration with the\ncomponent agents. Enalapril: Oral, initially 0.1 mg per kg of\nbody weight per day, the dosage being adjusted as needed and\ntolerated, up to a maximum of 0.5 mg per Kg of body weight\nper day.Hydrochlorothiazide: Oral, 1 to 2 mg per kg of body\nweight or 30 to 60 mg per square meter of body surface per day,\nas a single dose or in two divided doses, the dosage being\nadjusted according to response.', ''),
(586, 628, 'Management of moderate-to-severe hypertension.\nHeart failure; hypertension secondary to preeclampsia/eclampsia', 'I.V. administration: Monitor blood pressure closely\nfollowing I.V. administration. Response may be delayed and\nunpredictable in some patients; titrate cautiously to response.\nPatient compliance: Patients may be poorly compliant because\nof frequent dosing.', 'Hypersensitivity to hydralazine or any\ncomponent of the formulation; mitral valve rheumatic heart\ndisease. Hepatic impairment, renal impairment (dosage\nadjustment). Avoid during first and second trimester, no report\non serious harm following use in third trimester', 'May enhance the hypotensive effect of\nother Antihypertensives. Nonsteroidal Anti-Inflammatory\nAgents: May diminish the antihypertensive effect of\nHydralazine.', 'Angina pectoris, orthostatic hypotension,\nperipheral edema, fluid retention (diuretics needed) tachycardia,\nvascular collapse, pruritus, rash, urticarial, anorexia,\nconstipation, diarrhea, nausea and vomiting, agranulocytosis,\nthrombocytopenia, conjunctivitis', 'Congestive heart failure: Oral:\nInitial dose: 10-25 mg 3-4 times per day. Adjustment: Dosage\nmust be adjusted based on individual response. Target dose:\n225-300 mg/day in divided doses; use in combination with\nisosorbide dinitrate', ''),
(587, 629, 'Management of moderate-to-severe hypertension.\nHeart failure; hypertension secondary to preeclampsia/eclampsia', 'I.V. administration: Monitor blood pressure closely\nfollowing I.V. administration. Response may be delayed and\nunpredictable in some patients; titrate cautiously to response.\nPatient compliance: Patients may be poorly compliant because\nof frequent dosing.', 'Hypersensitivity to hydralazine or any\ncomponent of the formulation; mitral valve rheumatic heart\ndisease. Hepatic impairment, renal impairment (dosage\nadjustment). Avoid during first and second trimester, no report\non serious harm following use in third trimester', 'May enhance the hypotensive effect of\nother Antihypertensives. Nonsteroidal Anti-Inflammatory\nAgents: May diminish the antihypertensive effect of\nHydralazine.', 'Angina pectoris, orthostatic hypotension,\nperipheral edema, fluid retention (diuretics needed) tachycardia,\nvascular collapse, pruritus, rash, urticarial, anorexia,\nconstipation, diarrhea, nausea and vomiting, agranulocytosis,\nthrombocytopenia, conjunctivitis', 'Congestive heart failure: Oral:\nInitial dose: 10-25 mg 3-4 times per day. Adjustment: Dosage\nmust be adjusted based on individual response. Target dose:\n225-300 mg/day in divided doses; use in combination with\nisosorbide dinitrate', ''),
(588, 630, 'Treatment of heart failure, adjunct to standard\ntherapy', 'seeindividual medicine.', 'seeindividual medicine.', 'seeindividual medicine.', 'seeindividual medicine.', 'Adult, Congestive heart failure:\nOral: Initial: 1 tablet 3 times/day; may titrate to a maximum\ndose of 2 tablets 3 times/day', ''),
(589, 631, 'Isosorbide dinitrate (in combination with cardiac\nglycosides and diuretics or with hydralazine) effective for the\ntreatment of CHF or other low cardiac output states.\nConcomitant therapy with isosorbide dinitrate and hydralazine\nmay decrease mortality in patients with CHF; usually reserved\nfor patients who fail to respond to or are intolerant of first-line\ntherapy (e.g., ACE inhibitors) or in combination with such\ntherapy. Do not use isosorbide dinitrate as monotherapy for CHF', 'Severe hypotension (postural) can occur; paradoxical\nbradycardia and increased angina pectoris can accompany\nhypotension. Use with caution in volume depletion and\nmoderate hypotension, and use with extreme caution with\ninferior wall MI and suspected right ventricular infarctions.\nNitrates may precipitate or aggravate increased intracranial\npressure and subsequently may worsen clinical outcomes in\npatients with neurologic injury (eg, intracranial hemorrhage,\ntraumatic brain injury).', 'hypersensitivity to isosorbide dinitrate or\nany component of the formulation; hypersensitivity to organic\nnitrates; concurrent use with phosphodiesterase-5 (PDE-5)\ninhibitors (sildenafil, tadalafil, or vardenafil)', 'May enhance the adverse/toxic effect of\nother Hypotensive Agents. Phosphodiesterase 5 Inhibitors (e.g.,\nsildenafil) may enhance the vasodilatory effect of Vasodilators\n(Organic Nitrates). Caution with ethanol (may increase risk of\nhypotension)', 'hypotension, orthostatic hypotension, rebound\nhypertension, headache, methemoglobinemia', 'Heart failure (unlabeled\nuse):Oral: Immediate release (Note: Use in combination with\nhydralazine): Initial dose: 20 mg 3-4 times per day; Target\ndose: 160 mg/day in 4 divided doses', ''),
(590, 632, 'Isosorbide dinitrate (in combination with cardiac\nglycosides and diuretics or with hydralazine) effective for the\ntreatment of CHF or other low cardiac output states.\nConcomitant therapy with isosorbide dinitrate and hydralazine\nmay decrease mortality in patients with CHF; usually reserved\nfor patients who fail to respond to or are intolerant of first-line\ntherapy (e.g., ACE inhibitors) or in combination with such\ntherapy. Do not use isosorbide dinitrate as monotherapy for CHF', 'Severe hypotension (postural) can occur; paradoxical\nbradycardia and increased angina pectoris can accompany\nhypotension. Use with caution in volume depletion and\nmoderate hypotension, and use with extreme caution with\ninferior wall MI and suspected right ventricular infarctions.\nNitrates may precipitate or aggravate increased intracranial\npressure and subsequently may worsen clinical outcomes in\npatients with neurologic injury (eg, intracranial hemorrhage,\ntraumatic brain injury).', 'hypersensitivity to isosorbide dinitrate or\nany component of the formulation; hypersensitivity to organic\nnitrates; concurrent use with phosphodiesterase-5 (PDE-5)\ninhibitors (sildenafil, tadalafil, or vardenafil)', 'May enhance the adverse/toxic effect of\nother Hypotensive Agents. Phosphodiesterase 5 Inhibitors (e.g.,\nsildenafil) may enhance the vasodilatory effect of Vasodilators\n(Organic Nitrates). Caution with ethanol (may increase risk of\nhypotension)', '', 'Heart failure (unlabeled\nuse):Oral: Immediate release (Note: Use in combination with\nhydralazine): Initial dose: 20 mg 3-4 times per day; Target\ndose: 160 mg/day in 4 divided doses', ''),
(591, 633, 'Isosorbide dinitrate (in combination with cardiac\nglycosides and diuretics or with hydralazine) effective for the\ntreatment of CHF or other low cardiac output states.\nConcomitant therapy with isosorbide dinitrate and hydralazine\nmay decrease mortality in patients with CHF; usually reserved\nfor patients who fail to respond to or are intolerant of first-line\ntherapy (e.g., ACE inhibitors) or in combination with such\ntherapy. Do not use isosorbide dinitrate as monotherapy for CHF', 'Severe hypotension (postural) can occur; paradoxical\nbradycardia and increased angina pectoris can accompany\nhypotension. Use with caution in volume depletion and\nmoderate hypotension, and use with extreme caution with\ninferior wall MI and suspected right ventricular infarctions.\nNitrates may precipitate or aggravate increased intracranial\npressure and subsequently may worsen clinical outcomes in\npatients with neurologic injury (eg, intracranial hemorrhage,\ntraumatic brain injury).', 'hypersensitivity to isosorbide dinitrate or\nany component of the formulation; hypersensitivity to organic\nnitrates; concurrent use with phosphodiesterase-5 (PDE-5)\ninhibitors (sildenafil, tadalafil, or vardenafil)', 'May enhance the adverse/toxic effect of\nother Hypotensive Agents. Phosphodiesterase 5 Inhibitors (e.g.,\nsildenafil) may enhance the vasodilatory effect of Vasodilators\n(Organic Nitrates). Caution with ethanol (may increase risk of\nhypotension)', '', 'Heart failure (unlabeled\nuse):Oral: Immediate release (Note: Use in combination with\nhydralazine): Initial dose: 20 mg 3-4 times per day; Target\ndose: 160 mg/day in 4 divided doses', ''),
(592, 634, 'Treatment of hypertension, either alone or in\ncombination with other antihypertensive agents; adjunctive\ntherapy in treatment of heart failure (afterload reduction);\ntreatment of acute myocardial infarction within 24 hours in\nhemodynamically-stable patients to improve survival; treatment\nof left ventricular dysfunction after myocardial infarction.', 'see notes above and under Captopril.', 'see notes above and under Captopril.', 'see notes above and under Captopril.', 'see notes above and under Captopril.', 'Adult Heart failure: Oral:\nInitial: 2.5-5 mg once daily; thenincrease by no more than 10\nmg increments at intervals no less than 2 weeks to a maximum\ndaily dose of 40 mg. Usual maintenance: 5-40 mg/day as a\nsingle dose. Target dose: 20-40 mg once daily (ACC/AHA\n2009 Heart Failure Guidelines)\nNote: If patient has hyponatremia (serum sodium <130 mEq/L) or\nrenal impairment (Clcr<30 mL/minute or creatinine >3 mg/dL), then\ninitial dose should be 2.5 mg/day', 'at room temperature in a well-closed container.'),
(593, 635, 'Management of life-threatening recurrent\nventricular fibrillation (VF) or hemodynamically-unstable\nventricular tachycardia (VT) refractory to other antiarrhythmic\nagents or in patients intolerant of other agents used for these\nconditions', 'heart failure and impaired liver function, avoid\nexposure to sunlight. Arrhytmias, Hepatotoxicity, Proarrhytmic\neffects, Pulmonary toxicity.', 'Hypersensitivity to amiodarone, iodine, or\nany component of the formulation; severe sinus-node\ndysfunction; second- and third-degree heart block (except in\npatients with a functioning artificial pacemaker); bradycardia\ncausing syncope (except in patients with a functioning artificial\npacemaker); cardiogenic shock', 'amiodarone may interact with other drugs\nfor months after treatment is discontinued. It concentrates in the\nliver and may interfere with the hepatic metabolism of many\ndrugs. Oral anticoagulants, other antiarrythmics, digoxin,\nphenytoin; beta blockers, cimetidine and ritonavir.', 'frequent â€“hyperor hypothyroidism, neurotoxicity\n(including peripheral neuropathies), photosensitivity, headache nausea, vomiting, anorexia, constipation, fatigue and dizziness.\nLess frequent - pulmonary fibrosis, interstitial or\nhypersensitivity pneumonitis (include cough, dspnoea and slight\nfever), skin discoloration, ocular toxicity, arrhythmias,\nbradycardia, congestive cardiac failure.', 'Oral: Lower loading and\nmaintenance doses are preferable in women and all patients with\nlow body weight. Ventricular arrhythmias: Oral: 800-1600\nmg/day in 1-2 doses for 1-3 weeks, then when adequate\narrhythmia control is achieved, decrease to 600-800 mg/day in\n1-2 doses for 1 month; maintenance: 400 mg/day; lower doses\nare recommended for supraventricular arrhythmias. Pulseless\nVT or VF: I.V. push, I.O.: Initial: 300 mg rapid bolus; if\npulseless VT or VF continues after subsequent defibrillation\nattempt or recurs, administer supplemental dose of 150 mg.\nNote: In this setting, administering undiluted is preferred.\nUpon return of spontaneous circulation, follow with an infusion\nof 1 mg/minute for 6 hours, then 0.5 mg/minute for 18 hours\n(mean daily doses >2.1 g/day have been associated with\nhypotension). Breakthrough stable VT or SVT: 150 mg\nsupplemental doses in 100 mL D5W or NS over 10 minutes\n(mean daily doses >2.1 g/day have been associated with\nhypotension) I.V. to oral therapy conversion: Use the following\nas a guide: <1 week I.V. infusion: 800-1600 mg/day; 1 to 3\nweeks I.V. infusion: 600-800 mg/day; >3 weeks I.V. infusion:\n400 mg.\nNote: Conversion from I.V. to oral therapy has not been formally evaluated.\nSome experts recommend a 1-2 day overlap when converting from I.V. to\noral therapy especially when treating ventricular arrhythmias', ''),
(594, 636, 'Management of life-threatening recurrent\nventricular fibrillation (VF) or hemodynamically-unstable\nventricular tachycardia (VT) refractory to other antiarrhythmic\nagents or in patients intolerant of other agents used for these\nconditions', 'heart failure and impaired liver function, avoid\nexposure to sunlight. Arrhytmias, Hepatotoxicity, Proarrhytmic\neffects, Pulmonary toxicity.', 'Hypersensitivity to amiodarone, iodine, or\nany component of the formulation; severe sinus-node\ndysfunction; second- and third-degree heart block (except in\npatients with a functioning artificial pacemaker); bradycardia\ncausing syncope (except in patients with a functioning artificial\npacemaker); cardiogenic shock', 'amiodarone may interact with other drugs\nfor months after treatment is discontinued. It concentrates in the\nliver and may interfere with the hepatic metabolism of many\ndrugs. Oral anticoagulants, other antiarrythmics, digoxin,\nphenytoin; beta blockers, cimetidine and ritonavir.', 'frequent â€“hyperor hypothyroidism, neurotoxicity\n(including peripheral neuropathies), photosensitivity, headache nausea, vomiting, anorexia, constipation, fatigue and dizziness.\nLess frequent - pulmonary fibrosis, interstitial or\nhypersensitivity pneumonitis (include cough, dspnoea and slight\nfever), skin discoloration, ocular toxicity, arrhythmias,\nbradycardia, congestive cardiac failure.', 'Oral: Lower loading and\nmaintenance doses are preferable in women and all patients with\nlow body weight. Ventricular arrhythmias: Oral: 800-1600\nmg/day in 1-2 doses for 1-3 weeks, then when adequate\narrhythmia control is achieved, decrease to 600-800 mg/day in\n1-2 doses for 1 month; maintenance: 400 mg/day; lower doses\nare recommended for supraventricular arrhythmias. Pulseless\nVT or VF: I.V. push, I.O.: Initial: 300 mg rapid bolus; if\npulseless VT or VF continues after subsequent defibrillation\nattempt or recurs, administer supplemental dose of 150 mg.\nNote: In this setting, administering undiluted is preferred.\nUpon return of spontaneous circulation, follow with an infusion\nof 1 mg/minute for 6 hours, then 0.5 mg/minute for 18 hours\n(mean daily doses >2.1 g/day have been associated with\nhypotension). Breakthrough stable VT or SVT: 150 mg\nsupplemental doses in 100 mL D5W or NS over 10 minutes\n(mean daily doses >2.1 g/day have been associated with\nhypotension) I.V. to oral therapy conversion: Use the following\nas a guide: <1 week I.V. infusion: 800-1600 mg/day; 1 to 3\nweeks I.V. infusion: 600-800 mg/day; >3 weeks I.V. infusion:\n400 mg.\nNote: Conversion from I.V. to oral therapy has not been formally evaluated.\nSome experts recommend a 1-2 day overlap when converting from I.V. to\noral therapy especially when treating ventricular arrhythmias', ''),
(595, 637, 'Bretylium is used in ventricular arrhythmias\nunresponsive to conventional therapy following acute\nmyocardial infarction. Bretylium has also proven effective in\nthe treatment of premature ventricular contractions, and in the\nfacilitation of countershock in ventricular fibrillation in cases\nnot responding to countershock alone or countershock with\nother antiarrhythmics', 'avoid in patients with fixed cardiac outputs (i.e.,\nsevere aortic stenosis or severe pulmonary hypertension); risk of\nsevere hypotension, digitalized patients, may aggravate digitalis\ntoxicity, geriatrics (hypotension), hyperthermia, hypotension,\nrepeated IM injections in same area may cause atrophy/necrosis,\nrenal impairment, transient hypertension or an increase in\narrhythmias possible on administration', 'all contraindications are relative to the\nseriousness of the arrhythmia, digitalis-induced arrhythmias,\nhypersensitivity to bretylium', 'catecholamines, digoxine, erythromycin,\nclass Ia and class III antiarrhythmics, specific quinolones', 'hypotension, a transient initial increase in blood\npressure and heart rate, a worsening of cardiac arrhythmias,\nnausea and vomiting, increased frequency of pulmonary\nventricular contractions, respiratory depression, exacerbation of\ndigitalis-induced arrhythmias', 'Adult: I.M.: Ventricular\nArrhythmia; Treatment and Prophylaxis: do not dilute prior to\ninjection. Inject 5 to 10 milligrams/kilogram of body weight.\nThe dose may be repeated at 1 to 2 hour intervals if the\narrhythmia persists. Thereafter, administer the same dosage\nevery 6 to 8 hours. Intramuscular injection should not be made\ndirectly into or near a major nerve and the site of injection\nshould be varied on repeated administration. I.V.: Ventricular Arrhythmia; Treatment and Prophylaxis Ventricular Fibrillation:\nAdminister undiluted bretylium 5 milligrams/kilogram of body\nweight by rapid intravenous injection. The usual\ncardiopulmonary resuscitative measures, including electrical\ncardioversion, should be employed prior to and following the\ninjection in accordance with good medical practice. If\nventricular fibrillation persists, the dosage may be increased to\n10 mg/kg body weight and repeated as necessary. The\nmaximum loading dose should not exceed 30 mg/kg.', 'store at room temperature'),
(596, 638, 'Mild or transient episodes of heart block that do\nnot require electric shock or pacemaker therapy; serious\nepisodes of heart block and Adams-Stokes attacks (except when\ncaused by ventricular tachycardia or fibrillation); cardiac arrest\nuntil electric shock or pacemaker therapy is available;\nbronchospasm during anesthesia; adjunct to fluid and electrolyte\nreplacement therapy and other drugs and procedures in the\ntreatment of hypovolemic or septic shock and low cardiac\noutput states (eg, decompensated heart failure, cardiogenic\nshock).', 'elderly, diabetics, renal or cardiovascular disease,\ndistributive shock, seizure disorder or hyperthyroidism', 'hypersensitivity, angina, pre-existing\ncardiac arrhythmias, tachycardia.', 'sympathomimetic agents, general\nanesthetics.', 'bradycardia, tachycardia, headache, nervousness,\nnausea, vomiting, dyspnea', 'I.V: Cardiac arrhythmias: Adult:\nBradyarrhythmias, AV nodal block, or refractory torsade de\npointes: Continuous I.V. infusion: Usual range: 2-10\nmcg/minute; titrate to patient response.\nBrugada syndrome with electrical storm (unlabeled use): I.V.\nbolus: Initial: 1-2 mcg, followed by a continuous infusion of\n0.15-0.3 mcg/minute for 1 day; may repeat sequence if\nventricular tachycardia/fibrillation recurs.\nChild: Bradyarrhythmias, AV nodal block, or refractory torsade\nde pointes: Continuous I.V. infusion: Usual range: 0.05-2\nmcg/kg/minute; titrate to patient response. Patients may exhibit\ndose-dependent vasodilation due to unopposed beta2-agonism\nelicited by isoproterenol', 'store at room temperature.');
INSERT INTO `drugformulary` (`drugFormularyId`, `drugsId`, `indications`, `cautions`, `contraindications`, `drugInteractions`, `sideEffects`, `doseAndAdministration`, `storage`) VALUES
(597, 639, 'acute treatment of ventricular arrhythmias from\nmyocardial infarction or cardiac manipulation, cardiac\ncatheterization and those caused by digitalis intoxication', 'lower dosage in congestive heart failure, bradycardia,\nrenal and hepatic impairment, marked hypoxia, severe\nrespiratory depression, following cardiac surgery and in elderly.', 'sino-atrial disorder, any grade of\natrioventricular block or any other type of conduction\ndisturbances, severe myocardial depression, acute porphyria or\nhypovolaemia, history of hypersensitivity to amide type local\nanesthetics; pregnancy & children-safe use is not established', 'other antiarrhythmics (e.g., amiodarone),\nanticonvulsants, cimetidine, beta-blockers, saquinavir', 'dizziness, paraesthesia, drowsiness, confusion,\napnoea, respiratory depression, coma, seizures, and convulsions,\nhypotension, arrhythmias, heart block, cardiovascular collapse\nand brady cardia (may lead to cardiac arrest), nystagmus often\nan early sign of lidocaine overdosage.', 'Antiarrhythmic: Adult: VF or\npulseless VT (after defibrillation attempts, CPR, and\nvasopressor administration) if amiodarone is not available: I.V.,\nintraosseous (I.O.): Initial: 1-1.5 mg/kg. If refractory VF or\npulseless VT, repeat 0.5-0.75 mg/kg bolus every 5-10 minutes\n(maximum cumulative dose: 3 mg/kg). Follow with continuous\ninfusion (1-4 mg/minute) after return of perfusion.\nReappearance of arrhythmia during constant infusion: 0.5 mg/kg\nbolus and reassessment of infusion (Zipes, 2000).\nHemodynamically stable monomorphic VT: I.V.: 1-1.5 mg/kg;\nrepeat with 0.5-0.75 mg/kg every 5-10 minutes as necessary\n(maximum cumulative dose: 3 mg/kg). Follow with continuous\ninfusion of 1-4 mg/minute (or 14-57 mcg/kg/minute).\nChild: I.V., intraosseous (I.O.): Note: For use in VF or pulseless\nVT if amiodarone is not available; give after defibrillation\nattempts, CPR, and epinephrine: Loading dose: 1 mg/kg\n(maximum: 100 mg); follow with continuous infusion; may\nadminister second bolus of 0.5-1 mg/kg if delay between bolus\nand start of infusion is >15 minutes. Continuous infusion: 20-50\nmcg/kg/minute. Per the manufacturer, do not exceed 20\nmcg/kg/minute in patients with shock, hepatic disease, cardiac\narrest, or CHF', 'store at room temperature.'),
(598, 640, 'Treatment of angina pectoris, hypertension, or\nhemodynamically-stable acute myocardial infarction. Treatment\nof angina pectoris or hypertension; to reduce\nmortality/hospitalization in patients with heart failure (stable\nNYHA Class II or III) already receiving ACE inhibitors,\ndiuretics, and/or digoxin.', 'see under propranolol', 'see under propranolol', 'see under propranolol', 'see under propranolol', 'Adult: Atrial fibrillation/flutter\n(ventricular rate control), supraventricular tachycardia (SVT)\n(acute treatment; unlabeled use; Antman, 2004; Fuster, 2006;\nNeumar, 2010): I.V.: 2.5-5 mg every 2-5 minutes (maximum\ntotal dose: 15 mg over a 10-15 minute period). Note: Initiate\ncautiously in patients with concomitant heart failure; avoid in\npatients with decompensated heart failure.\nMaintenance: Oral (immediate release): 25-100 mg twice daily.\nHypertension/ventricular rate control: I.V. (in patients having\nnonfunctioning GI tract): Initial: 1.25-5 mg every 6-12 hours;\ntitrate initial dose to response. Initially, low doses may be\nappropriate to establish response; however, although not\nroutine, up to 15 mg administered as frequently as every 3 hours\nhas been employed in patients with refractory tachycardia.\nMyocardial infarction: Acute: I.V.: 5 mg every 2 minutes for 3\ndoses in early treatment of myocardial infarction; thereafter,\ngive 50 mg orally every 6 hours beginning 15 minutes after last\nI.V. dose and continue for 48 hours; then administer a\nmaintenance dose of 100 mg twice daily. Note: Do not initiate\nthis regimen in those with signs of heart failure, a low output\nstate, increased risk of cardiogenic shock, or other\ncontraindications (eg, second- or third-degree heart block). If\ninitial I.V. dosing is not tolerated, may give 25-50 mg orally\n(depending on degree of intolerance) every 6 hours beginning 15 minutes after the last I.V. dose or as soon as clinical\ncondition permits.', 'at room temperature'),
(599, 641, 'Treatment of angina pectoris, hypertension, or\nhemodynamically-stable acute myocardial infarction. Treatment\nof angina pectoris or hypertension; to reduce\nmortality/hospitalization in patients with heart failure (stable\nNYHA Class II or III) already receiving ACE inhibitors,\ndiuretics, and/or digoxin.', 'see under propranolol', 'see under propranolol', 'see under propranolol', 'see under propranolol', 'Adult: Atrial fibrillation/flutter\n(ventricular rate control), supraventricular tachycardia (SVT)\n(acute treatment; unlabeled use; Antman, 2004; Fuster, 2006;\nNeumar, 2010): I.V.: 2.5-5 mg every 2-5 minutes (maximum\ntotal dose: 15 mg over a 10-15 minute period). Note: Initiate\ncautiously in patients with concomitant heart failure; avoid in\npatients with decompensated heart failure.\nMaintenance: Oral (immediate release): 25-100 mg twice daily.\nHypertension/ventricular rate control: I.V. (in patients having\nnonfunctioning GI tract): Initial: 1.25-5 mg every 6-12 hours;\ntitrate initial dose to response. Initially, low doses may be\nappropriate to establish response; however, although not\nroutine, up to 15 mg administered as frequently as every 3 hours\nhas been employed in patients with refractory tachycardia.\nMyocardial infarction: Acute: I.V.: 5 mg every 2 minutes for 3\ndoses in early treatment of myocardial infarction; thereafter,\ngive 50 mg orally every 6 hours beginning 15 minutes after last\nI.V. dose and continue for 48 hours; then administer a\nmaintenance dose of 100 mg twice daily. Note: Do not initiate\nthis regimen in those with signs of heart failure, a low output\nstate, increased risk of cardiogenic shock, or other\ncontraindications (eg, second- or third-degree heart block). If\ninitial I.V. dosing is not tolerated, may give 25-50 mg orally\n(depending on degree of intolerance) every 6 hours beginning 15 minutes after the last I.V. dose or as soon as clinical\ncondition permits.', 'at room temperature'),
(600, 642, 'ventricular arrythmias, prevention of recurrent\ncardiac arrests, suppression of paroxysmal ventricular\ncontractions.', 'patients with sinus node dysfunction, conduction\ndefect, bradycardia, hypotension, cardiogenic shock, or cardiac\nor hepatic failure.', 'hypersensitivity to mexiletin', 'opioid analgesics, atropine, phenytoin,\nrifampicin, cimetidine, lignocaine, phenobarbital.', 'nausea, vomiting, heart burn, tremor, confusion,\ndizziness, and visual disturbances, hypotension, sinus\nbradycardia, conduction defects and exacerbation of\narrhythmias.', 'Adult: Oral: Initial: 200 mg every 8\nhours (may load with 400 mg if necessary); adjust dose every 2-\n3 days; usual dose: 200-300 mg every 8 hours; maximum: 1.2\ng/day (some patients respond to every 12-hour dosing). When\nswitching from another antiarrhythmic, initiate a 200 mg dose 6-\n12 hours after stopping former agents, 3-6 hours after stopping\nprocainamide. IV injection: 100 to 250 mg at a rate of 25 mg per\nminute, followed by an infusion at a rate of 250 mg over 1 hour,\n250 mg over the next 2 hours, and then at about 0.5 mg per\nminute for maintenance, according to patient response.', ' store in airtight containers.'),
(601, 643, 'ventricular arrythmias, prevention of recurrent\ncardiac arrests, suppression of paroxysmal ventricular\ncontractions.', 'patients with sinus node dysfunction, conduction\ndefect, bradycardia, hypotension, cardiogenic shock, or cardiac\nor hepatic failure.', 'hypersensitivity to mexiletin', 'opioid analgesics, atropine, phenytoin,\nrifampicin, cimetidine, lignocaine, phenobarbital.', '', 'Adult: Oral: Initial: 200 mg every 8\nhours (may load with 400 mg if necessary); adjust dose every 2-\n3 days; usual dose: 200-300 mg every 8 hours; maximum: 1.2\ng/day (some patients respond to every 12-hour dosing). When\nswitching from another antiarrhythmic, initiate a 200 mg dose 6-\n12 hours after stopping former agents, 3-6 hours after stopping\nprocainamide. IV injection: 100 to 250 mg at a rate of 25 mg per\nminute, followed by an infusion at a rate of 250 mg over 1 hour,\n250 mg over the next 2 hours, and then at about 0.5 mg per\nminute for maintenance, according to patient response.', ' store in airtight containers.'),
(602, 644, 'Phenytoin and phenytoin sodium are administered\norally. Phenytoin sodium also may be administered by slow IV\ninjection for the treatment of status epilepticus and by slow IV\nor IM injection for the prophylaxis and treatment of seizures\nduring neurosurgery.Ref Because parenteral administration of\nphenytoin is associated with more frequent and severe\ncomplications, the oral route is preferred for maintaining\ntherapeutic concentrations of the drug during nonemergency\nsituations; patients receiving the drug parenterally should\nroutinely be assessed for feasibility of oral therapy.', 'see\nunder antiepileptics', 'see\nunder antiepileptics', 'see\nunder antiepileptics', 'see\nunder antiepileptics', 'IV injections of phenytoin sodium\nshould be made directly into a large vein through a large-gauge\nneedle or IV catheter. The drug must be injected slowly at rates\nnot exceeding 50 mg/minute in adults and 1â€“3 mg/kg per minute\nin pediatric patients. Each injection of phenytoin sodium should\nbe followed by administration of sodium chloride injection\nthrough the same needle or IV catheter to reduce local venous\nirritation caused by the alkalinity of the injection solution.\nSubcutaneous and perivascular injection of phenytoin sodium\nshould be avoided.', ''),
(603, 645, 'Treatment of supraventricular arrhythmias. Note: In\nthe treatment of atrial fibrillation, use only when preferred treatment\nis ineffective or cannot be used. Use in paroxysmal atrial tachycardia\nwhen reflex stimulation or other measures are ineffective.', 'elderly, renal and hepatic impairment, asthma,\npregnancy; breastfeeding, blood dyscrasias, drug induced lupus\nerythematosus', 'Hypersensitivity to procainamide, procaine,\nother ester-type local anesthetics, or any component of the\nformulation; complete heart block; second-degree AV block or\nvarious types of hemiblock (without a functional artificial\npacemaker); SLE; torsade de pointes', 'other antiarrhythmics, anticholinergics,\ncimetidine, trimethoprim.', 'nausea, vomiting, diarrhoea, anorexia, severe\nhypotension, ventricular fibrillation, pericarditis, rashes,\npruritus, urticaria, flushing, fever, and angioedema, depression,\ndizziness, and psychosis; blood disorders include leukopenia,\nhaemolytic anemia and agranulocytosis after prolonged\ntreatment; lupus erythematosus-like syndrome', 'Adult: Dose must be titrated to\npatient\'s response. Antiarrhythmic: I.M.: 50 mg/kg/day divided\nevery 3-6 hours or 0.5-1 g every 4-8 hours. I.V.: Loading dose:\n15-18 mg/kg administered as slow infusion over 25-30 minutes\nor 100 mg/dose at a rate not to exceed 50 mg/minute repeated\nevery 5 minutes as needed to a total dose of 1 g.\nHemodynamically stable monomorphic VT or pre-excited atrial\nfibrillation. Loading dose: Infuse 20-50 mg/minute or 100 mg\nevery 5 minutes until arrhythmia controlled, hypotension\noccurs, QRS complex widens by 50% of its original width, or\ntotal of 17 mg/kg is given. Follow with a continuous infusion of\n1-4 mg/minute. Note: Not recommended for use in ongoing\nventricular fibrillation (VF) or pulseless ventricular tachycardia (VT)\ndue to prolonged administration time and uncertain efficacy Maintenance dose: 1-4 mg/minute by continuous infusion.\nMaintenance infusions should be reduced by one-third in\npatients with moderate renal or cardiac impairment and by twothirds in patients with severe renal or cardiac impairment. Oral:\nSustained release formulation: Maintenance: 50 mg/kg/24 hours\ngiven in divided doses every 6 hours. Child: Must be titrated to\npatient\'s response: Arrhythmias: I.M.: 20-30 mg/kg/day divided\nevery 4-6 hours; maximum: 4 g/day. I.V.: Load: 3-6 mg/kg/dose\nover 5 minutes not to exceed 100 mg/dose; may repeat every 5-\n10 minutes to maximum of 15 mg/kg/load. Maintenance as\ncontinuous I.V. infusion: 20-80 mcg/kg/minute; maximum: 2\ng/24 hours.', 'store in airtight containers and at room temperature.\nProtect from light.'),
(604, 646, 'Treatment of supraventricular arrhythmias. Note: In\nthe treatment of atrial fibrillation, use only when preferred treatment\nis ineffective or cannot be used. Use in paroxysmal atrial tachycardia\nwhen reflex stimulation or other measures are ineffective.', 'elderly, renal and hepatic impairment, asthma,\npregnancy; breastfeeding, blood dyscrasias, drug induced lupus\nerythematosus', 'Hypersensitivity to procainamide, procaine,\nother ester-type local anesthetics, or any component of the\nformulation; complete heart block; second-degree AV block or\nvarious types of hemiblock (without a functional artificial\npacemaker); SLE; torsade de pointes', 'other antiarrhythmics, anticholinergics,\ncimetidine, trimethoprim.', 'nausea, vomiting, diarrhoea, anorexia, severe\nhypotension, ventricular fibrillation, pericarditis, rashes,\npruritus, urticaria, flushing, fever, and angioedema, depression,\ndizziness, and psychosis; blood disorders include leukopenia,\nhaemolytic anemia and agranulocytosis after prolonged\ntreatment; lupus erythematosus-like syndrome', 'Adult: Dose must be titrated to\npatient\'s response. Antiarrhythmic: I.M.: 50 mg/kg/day divided\nevery 3-6 hours or 0.5-1 g every 4-8 hours. I.V.: Loading dose:\n15-18 mg/kg administered as slow infusion over 25-30 minutes\nor 100 mg/dose at a rate not to exceed 50 mg/minute repeated\nevery 5 minutes as needed to a total dose of 1 g.\nHemodynamically stable monomorphic VT or pre-excited atrial\nfibrillation. Loading dose: Infuse 20-50 mg/minute or 100 mg\nevery 5 minutes until arrhythmia controlled, hypotension\noccurs, QRS complex widens by 50% of its original width, or\ntotal of 17 mg/kg is given. Follow with a continuous infusion of\n1-4 mg/minute. Note: Not recommended for use in ongoing\nventricular fibrillation (VF) or pulseless ventricular tachycardia (VT)\ndue to prolonged administration time and uncertain efficacy Maintenance dose: 1-4 mg/minute by continuous infusion.\nMaintenance infusions should be reduced by one-third in\npatients with moderate renal or cardiac impairment and by twothirds in patients with severe renal or cardiac impairment. Oral:\nSustained release formulation: Maintenance: 50 mg/kg/24 hours\ngiven in divided doses every 6 hours. Child: Must be titrated to\npatient\'s response: Arrhythmias: I.M.: 20-30 mg/kg/day divided\nevery 4-6 hours; maximum: 4 g/day. I.V.: Load: 3-6 mg/kg/dose\nover 5 minutes not to exceed 100 mg/dose; may repeat every 5-\n10 minutes to maximum of 15 mg/kg/load. Maintenance as\ncontinuous I.V. infusion: 20-80 mcg/kg/minute; maximum: 2\ng/24 hours.', 'store in airtight containers and at room temperature.\nProtect from light.'),
(605, 647, 'Management of hypertension; angina pectoris;\npheochromocytoma; essential tremor; supraventricular\narrhythmias (such as atrial fibrillation and flutter, AV nodal reentrant tachycardias), ventricular tachycardias (catecholamineinduced arrhythmias, digoxin toxicity); prevention of\nmyocardial infarction; migraine headache prophylaxis;\nsymptomatic treatment of hypertrophic subaortic stenosis\n(hypertrophic obstructive cardiomyopathy)', 'peripheral arterial insufficiency, first degree\natrioventricular block, major surgery, renal & hepatic\nimpairment, diabetes, myasthenia gravis, pregnancy. Avoid\nabrupt withdrawal.', 'Hypersensitivity to propranolol, betablockers, or any component of the formulation; uncompensated\ncongestive heart failure (unless the failure is due to\ntachyarrhythmias being treated with propranolol), cardiogenic\nshock, severe sinus bradycardia or heart block greater than firstdegree (except in patients with a functioning artificial\npacemaker), severe hyperactive airway disease (asthma or\nCOPD).', 'chlorpromazine, phenothiazines,\nthioxanthenes, lidocaine, cimetidine, hepatic enzyme inducers,(barbiturates, phenytoin, rifampicin), non-steroidal antiinflammatory agents, digoxin, verapamil, neuromuscular\nblocking agents, anaesthetic agents, insulin or oral antidiabetic\nagents.', 'heart failure, heart block, hypotension,\nbronchospasm, fatigue and coldness of the extremities,\nheadache, depression, dizziness, confusion and sleep\ndisturbances, dry mouth, nausea, vomiting, diarrhea, impotence\nor decreased libido.', 'Oral: Adult: Tachyarrhythmias:\nOral: 10 to 30 mg/dose every 6-8 hours. I.V.: 1to 3 mg/dose\nslow IVP; repeat every 2-5 minutes up to a total of 5 mg; titrate\ninitial dose to desired response or 0.5 to 1 mg over 1 minute;\nmay repeat, if necessary, up to a total maximum dose of 0.1\nmg/kg. Note: Once response achieved or maximum dose\nadministered, additional doses should not be given for at least 4\nhours.Thyroid storm: Oral: 60-80 mg every 4 hours; may\nconsider the use of an intravenous shorter-acting beta-blocker\n(ie, esmolol). I.V.: 0.5-1 mg administered over 10 minutes every\n3 hours.Thyrotoxicosis: Oral: 10-40 mg/dose every 6-8 hours;\nmay also consider administering extended or sustained release\nformulations. Variceal hemorrhage prophylaxis (unlabeled\nuse)Oral: Primary prophylaxis: Initial: 20 mg twice daily; adjust\nto maximal tolerated dose. Note: Risk factors for hemorrhage include Child-Pugh class B/C or variceal red wale markings on\nendoscopy.Secondary prophylaxis: Initial: 20 mg twice daily;\nadjust to maximal tolerated dose 10 to 30mg/dose every 6-8\nhours.Child: Initial: 0.5to 1mg/kg/day in divided doses every 6-\n8 hours; titrate dosage upward every 3-7 days; usual dose: 2-\n6mg/kg/day; higher doses may be needed; do not exceed\n16mg/kg/day or 60mg/day.IV: Adult: 1mg/dose slow IV\ninjection; repeat every 5 minutes up to a total of 5mg.Child:\n0.01-0.1mg/kg/dose slow IV injection over 10 minutes;\nmaximum dose: 1mg for infants; 3mg for children.', 'store at room temperature'),
(606, 648, 'Management of hypertension; angina pectoris;\npheochromocytoma; essential tremor; supraventricular\narrhythmias (such as atrial fibrillation and flutter, AV nodal reentrant tachycardias), ventricular tachycardias (catecholamineinduced arrhythmias, digoxin toxicity); prevention of\nmyocardial infarction; migraine headache prophylaxis;\nsymptomatic treatment of hypertrophic subaortic stenosis\n(hypertrophic obstructive cardiomyopathy)', 'peripheral arterial insufficiency, first degree\natrioventricular block, major surgery, renal & hepatic\nimpairment, diabetes, myasthenia gravis, pregnancy. Avoid\nabrupt withdrawal.', 'Hypersensitivity to propranolol, betablockers, or any component of the formulation; uncompensated\ncongestive heart failure (unless the failure is due to\ntachyarrhythmias being treated with propranolol), cardiogenic\nshock, severe sinus bradycardia or heart block greater than firstdegree (except in patients with a functioning artificial\npacemaker), severe hyperactive airway disease (asthma or\nCOPD).', 'chlorpromazine, phenothiazines,\nthioxanthenes, lidocaine, cimetidine, hepatic enzyme inducers,(barbiturates, phenytoin, rifampicin), non-steroidal antiinflammatory agents, digoxin, verapamil, neuromuscular\nblocking agents, anaesthetic agents, insulin or oral antidiabetic\nagents.', 'heart failure, heart block, hypotension,\nbronchospasm, fatigue and coldness of the extremities,\nheadache, depression, dizziness, confusion and sleep\ndisturbances, dry mouth, nausea, vomiting, diarrhea, impotence\nor decreased libido.', 'Oral: Adult: Tachyarrhythmias:\nOral: 10 to 30 mg/dose every 6-8 hours. I.V.: 1to 3 mg/dose\nslow IVP; repeat every 2-5 minutes up to a total of 5 mg; titrate\ninitial dose to desired response or 0.5 to 1 mg over 1 minute;\nmay repeat, if necessary, up to a total maximum dose of 0.1\nmg/kg. Note: Once response achieved or maximum dose\nadministered, additional doses should not be given for at least 4\nhours.Thyroid storm: Oral: 60-80 mg every 4 hours; may\nconsider the use of an intravenous shorter-acting beta-blocker\n(ie, esmolol). I.V.: 0.5-1 mg administered over 10 minutes every\n3 hours.Thyrotoxicosis: Oral: 10-40 mg/dose every 6-8 hours;\nmay also consider administering extended or sustained release\nformulations. Variceal hemorrhage prophylaxis (unlabeled\nuse)Oral: Primary prophylaxis: Initial: 20 mg twice daily; adjust\nto maximal tolerated dose. Note: Risk factors for hemorrhage include Child-Pugh class B/C or variceal red wale markings on\nendoscopy.Secondary prophylaxis: Initial: 20 mg twice daily;\nadjust to maximal tolerated dose 10 to 30mg/dose every 6-8\nhours.Child: Initial: 0.5to 1mg/kg/day in divided doses every 6-\n8 hours; titrate dosage upward every 3-7 days; usual dose: 2-\n6mg/kg/day; higher doses may be needed; do not exceed\n16mg/kg/day or 60mg/day.IV: Adult: 1mg/dose slow IV\ninjection; repeat every 5 minutes up to a total of 5mg.Child:\n0.01-0.1mg/kg/dose slow IV injection over 10 minutes;\nmaximum dose: 1mg for infants; 3mg for children.', 'store at room temperature'),
(607, 649, 'Quinidine sulfate salts: Conversion and prevention\nof relapse into atrial fibrillation and/or flutter; suppression of\nventricular arrhythmias. Note: Due to proarrhythmic effects, use\nshould be reserved for life-threatening arrhythmias. Moreover,\nthe use of quinidine has largely been replaced by more\neffective/safer antiarrhythmic agents and/or nonpharmacologic\ntherapies (eg, radiofrequency ablation).', 'hepatotoxicity, hypersensitivity reactions,\nproarrhythmic effects: disease-related concerns, atrial\nfibrillation/flutter, conduction disturbances: electrolyte\nimbalance, G6PD deficiency, heart failure, concurrent drug\ntherapy issues (e.g.digoxin), elderly, do not interchange the\ndifferent salt products.', 'complete heart block, digitalis overdosage', 'digoxin, amiodarone, rifampicin,\nPhenobarbital & phenytoin, nelfinavir & ritonavir, sodium\nbicarbonate, carbonic anhydrase inhibitors, other\nantiarrhythmics, phenothiazines, anticholinergics, reserpine, and\nanticonvulsants.', 'the elderly are particularly susceptible to adverse\nnervous system effects and diarrhea, abdominal cramps, bitter\ntaste, nausea and vomiting. Hypersensitivity reactions may\noccur, monitor patient after first dose. Acute hypotension,\ncinchonism and, in severe toxicity, photophobia, confusion,\nsystemic lupus erythematosus and psychosis may occur', 'Adult: Oral: Initial test dose of 200\nmg to detect hypersensitivity to quinidine. Note: Dosage\nexpressed in terms of the salt: 267 mg of quinidine gluconate =\n200 mg of quinidine sulfate.\nAntiarrhythmic: Oral: Immediate release formulations:\nQuinidine sulfate: Initial: 200-400 mg/dose every 6 hours the\ndose may be increased cautiously to desired effect. Extended\nrelease formulations:Quinidine sulfate: Initial: 300 mg every 8-\n12 hours; the dose may be increased cautiously to desired effect.\nQuinidine gluconate: Initial: 324 mg every 8-12 hours; the dose\nmay be increased cautiously to desired effect.', 'store at room temperature and protect from light'),
(608, 650, 'Oral: Treatment of hypertension; angina pectoris\n(vasospastic, chronic stable, unstable); supraventricular\ntachyarrhythmia (PSVT, atrial fibrillation/flutter [rate control]),;\nI.V.: Supraventricular tachyarrhythmia (PSVT, atrial\nfibrillation/flutter [rate control])', 'first-degree atrioverntricular block; acute phase of\nmyocardial infarction; renal and hepatic impairment; children,\npregnancy, breast-feeding, muscular dystrophy, aortic stenosis', 'Hypersensitivity to verapamil or any\ncomponent of the formulation; severe left ventricular\ndysfunction; hypotension (systolic pressure <90 mm Hg) or\ncardiogenic shock; sick sinus syndrome (except in patients with\na functioning artificial ventricular pacemaker); second- or thirddegree AV block (except in patients with a functioning artificial\nventricular pacemaker); atrial flutter or fibrillation and an\naccessory bypass tract (Wolff-Parkinson-White [WPW]\nsyndrome, Lown-Ganong-Levine syndrome), Additional\ncontraindications include concurrent use of I.V. beta-blocking\nagents; ventricular tachycardia.', 'beta blocking-agents; antiarrhythmics, other\nhighly protein-bound agents, carbamazepine, grape fruit juice,\ndigoxin, lithium & cyclosporine and calcium salts.', '', 'Adult Chronic atrial fibrillation\n(rate-control), PSVT prophylaxis: Oral: Immediate release: 240-\n480 mg/day in 3-4 divided doses; Usual dose range (Fuster,\n2006): 120-360 mg/day in divided doses. SVT I.V.: 2.5-5 mg\nover 2 minutes; second dose of 5-10 mg (~0.15 mg/kg) may be\ngiven 15-30 minutes after the initial dose if patient tolerates, but\ndoes not respond to initial dose; maximum total dose: 20-30 mg.\nDosing: Pediatric SVT: Note: Verapamil is no longer included\nin the Pediatric Advanced Life Support (PALS) tachyarrhythmia\nalgorithm Children: 1-15 years: I.V.: 0.1-0.3 mg/kg/dose over 2 minutes;\nmaximum: 5 mg/dose, may repeat dose in 30 minutes if\ninadequate response; maximum for second dose: 10 mg.', ''),
(609, 651, 'Oral: Treatment of hypertension; angina pectoris\n(vasospastic, chronic stable, unstable); supraventricular\ntachyarrhythmia (PSVT, atrial fibrillation/flutter [rate control]),;\nI.V.: Supraventricular tachyarrhythmia (PSVT, atrial\nfibrillation/flutter [rate control])', 'first-degree atrioverntricular block; acute phase of\nmyocardial infarction; renal and hepatic impairment; children,\npregnancy, breast-feeding, muscular dystrophy, aortic stenosis', 'Hypersensitivity to verapamil or any\ncomponent of the formulation; severe left ventricular\ndysfunction; hypotension (systolic pressure <90 mm Hg) or\ncardiogenic shock; sick sinus syndrome (except in patients with\na functioning artificial ventricular pacemaker); second- or thirddegree AV block (except in patients with a functioning artificial\nventricular pacemaker); atrial flutter or fibrillation and an\naccessory bypass tract (Wolff-Parkinson-White [WPW]\nsyndrome, Lown-Ganong-Levine syndrome), Additional\ncontraindications include concurrent use of I.V. beta-blocking\nagents; ventricular tachycardia.', 'beta blocking-agents; antiarrhythmics, other\nhighly protein-bound agents, carbamazepine, grape fruit juice,\ndigoxin, lithium & cyclosporine and calcium salts.', '', 'Adult Chronic atrial fibrillation\n(rate-control), PSVT prophylaxis: Oral: Immediate release: 240-\n480 mg/day in 3-4 divided doses; Usual dose range (Fuster,\n2006): 120-360 mg/day in divided doses. SVT I.V.: 2.5-5 mg\nover 2 minutes; second dose of 5-10 mg (~0.15 mg/kg) may be\ngiven 15-30 minutes after the initial dose if patient tolerates, but\ndoes not respond to initial dose; maximum total dose: 20-30 mg.\nDosing: Pediatric SVT: Note: Verapamil is no longer included\nin the Pediatric Advanced Life Support (PALS) tachyarrhythmia\nalgorithm Children: 1-15 years: I.V.: 0.1-0.3 mg/kg/dose over 2 minutes;\nmaximum: 5 mg/dose, may repeat dose in 30 minutes if\ninadequate response; maximum for second dose: 10 mg.', ''),
(610, 652, 'Adjunct in the management of primary\nhypercholesterolemia; pruritus associated with elevated levels\nof bile acids; regression of arteriolosclerosis.', 'patients with constipation and phenylketoneuria, risk\nof vitamin deficiencies in prolonged use.', 'complete biliary and bowel obstruction,\nactive peptic, ulcer disease; sensitivity to tartrazine.', 'fat-soluble vitamins, warfarin, digoxin,\nthiazides, barbiturates, aspirin, tetracyclines and thyroxine', 'frequently unpalatable or associated with bloated\nfeeling, nausea, vomiting, constipation occurs frequently,\nheadache and dizziness, (<l%). May aggravate\nhypertriglyceridaemia; see also notes above.\nNote: constipation, most common side effect of cholestyramine, may\nbe, countered by increased fiber and water intake', 'frequently unpalatable or associated with bloated\nfeeling, nausea, vomiting, constipation occurs frequently,\nheadache and dizziness, (<l%). May aggravate\nhypertriglyceridaemia; see also notes above.\nNote: constipation, most common side effect of cholestyramine, may\nbe, countered by increased fiber and water intake', 'store in airtight containers and at room temperature.'),
(611, 653, '', '', '', '', '', '', ''),
(612, 654, '', '', '', '', '', '', ''),
(613, 655, '', '', '', '', '', '', ''),
(614, 656, '', '', '', '', '', '', ''),
(615, 657, '', '', '', '', '', '', ''),
(616, 658, '', '', '', '', '', '', ''),
(617, 659, '', '', '', '', '', '', ''),
(618, 660, '', '', '', '', '', '', ''),
(619, 661, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

DROP TABLE IF EXISTS `drugs`;
CREATE TABLE IF NOT EXISTS `drugs` (
  `drugsId` int(11) NOT NULL AUTO_INCREMENT,
  `drugsName` varchar(300) NOT NULL,
  `drugsBrandName` varchar(300) DEFAULT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0',
  `drugsStatus` enum('0','1') NOT NULL DEFAULT '1',
  `dosageForm` varchar(100) DEFAULT NULL,
  `strength` varchar(110) DEFAULT NULL,
  `volume` varchar(110) DEFAULT NULL,
  `category` varchar(110) DEFAULT NULL,
  `subCategory` varchar(110) DEFAULT NULL,
  `unit` varchar(110) DEFAULT NULL,
  `brandName` varchar(110) DEFAULT NULL,
  PRIMARY KEY (`drugsId`),
  KEY `drugsId` (`drugsId`)
) ENGINE=InnoDB AUTO_INCREMENT=662 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`drugsId`, `drugsName`, `drugsBrandName`, `isDeleted`, `drugsStatus`, `dosageForm`, `strength`, `volume`, `category`, `subCategory`, `unit`, `brandName`) VALUES
(517, 'Aluminium Hydroxide Mixture or Gel, 320 C mg/5ml', NULL, 0, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(518, 'Aluminium Hydroxide Suspension, 360mg/5ml', NULL, 0, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(519, 'Aluminium Hydroxide Chewable tablet, 500mg', NULL, 0, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(520, 'Aluminium Hydroxide and Magnesium Hydroxide Suspension, 220mg+220mg/ 5 ml', NULL, 0, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(521, 'Aluminium Hydroxide and Magnesium Hydroxide Tablet (chewable), 400mg + 400mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(522, 'Aluminium Hydroxide + Magnesium Hydroxide + Simethicone Suspension, 225mg+200 mg+25 mg/ 5 ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(523, 'Aluminium Hydroxide and Magnesium Trisilicate Suspension, 310mg+620mg in 5ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(524, 'Aluminium Hydroxide and Magnesium Trisilicate Tablet (chewable), 120 mg+250 mg; 250mg+500mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(525, 'Calcium Carbonate Tablet, 350mg, 500mg, 700mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(526, 'Famotidine+calciumcarbonate+Magnesium T hydroxideTablet, 10mg+800mg+165mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(527, 'Magnesium Hydroxide Suspension, 375 mg/5ml, 7.75 %', NULL, 0, '1', '', '', '', '', '', '', ''),
(528, 'Magnesium Hydroxide Tablet (chewable), 300 mg, 311 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(529, 'Magnesium Trisilicate Tablet (Chewable), 500 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(530, 'Sodium Alginate+Magnesium Hydroxide+Aluminum Hydroxide+Siimethicone Oral suspension, 100mg+250mg+125mg+50mg in 5ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(531, 'Sodium bicarbonate+ Sodium Alginate+ Calcium carbonate Tablet, 276mg+500mg+160mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(532, 'Cimetidine Injection, 200mg/ml in 2ml ampoule', NULL, 0, '1', '', '', '', '', '', '', ''),
(533, 'Cimetidine  Syrup, 200mg/5ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(534, 'Cimetidine  Tablet, 200mg, 400mg, 800mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(535, 'Cimetidine Tablet, (chewable), 200mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(536, 'Famotidine Tablet, 20 mg, 40 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(537, 'Nizatidine Capsule, 150mg, 300mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(538, 'Nizatidine Injection, 25mg/ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(539, 'Ranitidine Injection, 10 mg/ml in 5ml ampoule; 25mg/ml in 10ml ampoule', NULL, 0, '1', '', '', '', '', '', '', ''),
(540, 'Ranitidine Tablet, 150 mg, 300mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(541, 'Misoprostol Tablet, 20mcg, 40mcg', NULL, 0, '1', '', '', '', '', '', '', ''),
(542, 'Esomeprazole Capsule, 20mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(543, 'Esomeprazole Tablet (e/c), 20mg, 40mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(544, 'Esomeprazole Oral suspension (pediatric), 20mg, 40mg/sachet', NULL, 0, '1', '', '', '', '', '', '', ''),
(545, 'Esomeprazole Powder for injection, 20mg, 40mg/5ml vial', NULL, 0, '1', '', '', '', '', '', '', ''),
(546, 'Lansoprazole Capsule, 15mg, 30mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(547, 'Lansoprazole Tablet, 15mg, 30mg (enteric coated)', NULL, 0, '1', '', '', '', '', '', '', ''),
(548, 'Lansoprazole Oral suspension (granule), 30mg/sachet', NULL, 0, '1', '', '', '', '', '', '', ''),
(549, 'Omeprazole Capsule (enclosing e/c granules), 20 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(550, 'Omeprazole Tablet, 20mg (enteric coated)', NULL, 0, '1', '', '', '', '', '', '', ''),
(551, 'Pantoprazole Tablet, 20mg, 40mg (enteric coated)', NULL, 0, '1', '', '', '', '', '', '', ''),
(552, 'Bismuth subsalicylate Liquid, 262 mg/15ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(553, 'Bismuth subsalicylate  Tablet, 300 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(554, 'Tripotassium Dicitratobismuthate Liquid, 120 mg/5ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(555, 'Tripotassium Dicitratobismuthate Tablet, 120 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(556, 'Sucralfate Tablet, 1 g (Scored)', NULL, 0, '1', '', '', '', '', '', '', ''),
(557, 'Atropine Sulphate Injection, 1 mg/ml in 1ml ampoule', NULL, 0, '1', '', '', '', '', '', '', ''),
(558, 'Chlordiazepoxide + Clidinium Bromide Tablet, 5 mg + 2.5 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(559, 'Drotaverine Tablet, 40 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(560, 'Drotaverine Injection, 40mg/2ml ampoule', NULL, 0, '1', '', '', '', '', '', '', ''),
(561, 'Scopolamine (Hyoscine) Butylbromide Drops, 5mg/5ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(562, 'Scopolamine (Hyoscine) Butylbromide Injection, 20mg/ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(563, 'Scopolamine (Hyoscine) Butylbromide Tablet, 10mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(564, 'Scopolamine (Hyoscine) Butylbromide,Suppository, 7.5mg, 10mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(565, 'Scopolamine (hyoscine) Hydrobromide Injection, 0.4 mg/ml, 0.6 mg/ml in 1ml ampoule', NULL, 0, '1', '', '', '', '', '', '', ''),
(566, 'Scopolamine (hyoscine) Hydrobromide Tablet, 0.6 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(567, 'Propantheline Bromide Tablet, 15 mg, 30 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(568, 'Chlorpromazine Hydrochloride Drop, 25 mg/ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(569, 'Chlorpromazine Hydrochloride Injection, 25mg/1ml, 25mg/2ml,50mg/2ml in 1ml and 2ml ampoule', NULL, 0, '1', '', '', '', '', '', '', ''),
(570, 'Chlorpromazine Hydrochloride Syrup, 25 mg/5 ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(571, 'Chlorpromazine Hydrochloride Tablet, 25 mg, 100 mg (film/sugar coated)', NULL, 0, '1', '', '', '', '', '', '', ''),
(572, 'Dimenhydrinate Tablet, 50 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(573, 'Domperidone Tablets, 10 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(574, 'Granisetron Hydrochloride Tablet, 2mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(575, 'Meclizine Hydrochloride Tablet, 12.5 mg, 25 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(576, 'Metoclopramide Hydrochloride Drop, 0.2 mg/drop', NULL, 0, '1', '', '', '', '', '', '', ''),
(577, 'Metoclopramide Hydrochloride Injection, 5 mg/ml, 5ml/2ml in 2 ml ampoule', NULL, 0, '1', '', '', '', '', '', '', ''),
(578, 'Metoclopramide Hydrochloride Syrup, 5mg/5ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(579, 'Metoclopramide Hydrochloride Tablet, 10 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(580, 'Ondansetrone Solution for injection and Infusion, 4mg/2ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(581, 'Promethazine Hydrochloride Elixir, 5 mg/5 ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(582, 'Promethazine Hydrochloride Injection, 25 mg/ml, 25/2ml in 1 ml and 2 ml ampoules', NULL, 0, '1', '', '', '', '', '', '', ''),
(583, 'Promethazine Hydrochloride Suppository, 25 mg, 50 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(584, 'Promethazine Hydrochloride Tablets, 10 mg, 25 mg (film/sugar coated)', NULL, 0, '1', '', '', '', '', '', '', ''),
(585, 'Thiethylperazine Maleate Injection, 6.5 mg/ ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(586, 'Thiethylperazine Maleate Suppository, 6.5 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(587, 'Thiethylperazine Maleate Tablet, 6.5 mg (film/ sugar coated)', NULL, 0, '1', '', '', '', '', '', '', ''),
(588, 'Bisacodyl Tablet, 5 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(589, 'Bisacodyl Suppository, 5 mg, 10 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(590, 'Cascara Sagrada Tablet, 125 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(591, 'Castor oil Liquid, 30ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(592, 'Dioctyl sodium Sulphosuccinate (Docusate Sodium) Tablet, 50 mg, 100 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(593, 'Dioctyl sodium Sulphosuccinate (Docusate Sodium) Syrup, 4 mg/ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(594, 'Glycerin (Glycerol) Suppository, 1 g, 1.346 g, 2 g, 2.76 g', NULL, 0, '1', '', '', '', '', '', '', ''),
(595, 'Lactulose Enema', NULL, 0, '1', '', '', '', '', '', '', ''),
(596, 'Lactulose Syrup', NULL, 0, '1', '', '', '', '', '', '', ''),
(597, 'Liquid parafin, Heavy', NULL, 0, '1', '', '', '', '', '', '', ''),
(598, 'Magnesium sulphate Crystal', NULL, 0, '1', '', '', '', '', '', '', ''),
(599, 'Methyl Cellulose Tablet, 500 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(600, 'Psyllium Powder', NULL, 0, '1', '', '', '', '', '', '', ''),
(601, 'Senna Tablet (total sennosides), 7.5 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(602, 'Diphenoxylate with Atropine Sulphate Tablet, 2.5 mg + 0.05 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(603, 'Loperamide Capsule, 2 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(604, 'Zinc Sulphate Tablet (dispersible), 10mg, 20mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(605, 'Zinc Sulphate Oral liquid, 10mg /unit', NULL, 0, '1', '', '', '', '', '', '', ''),
(606, 'Activated Charcoal Tablet, 125 mg, 250mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(607, 'Simethicone Tablet (chewable), 60mg, 80mg, and 95mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(608, 'Simethicone Capsule, 95 mg, 125 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(609, 'Pancreatin Tablet, 325 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(610, 'Bismuth Subgallate Compound (Bismuth Subgallate + Bismuth Oxide +Peru Balsam + Zinc Oxide) Ointment, 2.25% + 0.87% + 1.875% + 10.75% ', NULL, 0, '1', '', '', '', '', '', '', ''),
(611, 'Bismuth Subgallate Compound (Bismuth Subgallate + Bismuth Oxide +Peru Balsam + Zinc Oxide) Suppository, 5mg + 24mg + 49mg + 296mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(612, 'Bismuth Subgallate Compound with Hydrocortisone (Bismuth Subgallate + Bismuth Oxide + Peru Balsam + Zinc Oxide + Hydrocortisone acetate + Benzyl Benzoate) Ointment, 2.25% + 0.875% + 1.875% +10.75% + 0.25% +1.25% ', NULL, 0, '1', '', '', '', '', '', '', ''),
(613, 'Bismuth Subgallate Compound with Hydrocortisone (Bismuth Subgallate + Bismuth Oxide + Peru Balsam + Zinc Oxide + Hydrocortisone acetate + Benzyl Benzoate) Suppository, 59mg + 24mg + 49mg +296mg + 10mg + 33mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(614, 'Lidocaine + Aluminium Acetate + Zinc Oxide + Hydrocortisone Acetate Ointment, 50 mg + 35 mg + 180 mg + 2.5 mg ', NULL, 0, '1', '', '', '', '', '', '', ''),
(615, 'Lidocaine + Aluminium Acetate + Zinc Oxide + Hydrocortisone Acetate Suppository, 60 mg + 50 mg + 500 mg + 5 mg.', NULL, 0, '1', '', '', '', '', '', '', ''),
(616, 'Lignocaine + Tribenoside Suppository, 40mg + 400mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(617, 'Prednisolone Caproate + Dibucaine Hydrochloride + Hexachlorophene + Clemizole undecenoate Ointment, 0.19 % + 0.5 % + 0.5 % + 0.5 % + 1 % ', NULL, 0, '1', '', '', '', '', '', '', ''),
(618, 'Prednisolone Caproate + Dibucaine Hydrochloride + Hexachlorophene + Clemizole undecenoate Suppository, 1.3 mg + 1 mg + 2.5 mg + 5 mg.', NULL, 0, '1', '', '', '', '', '', '', ''),
(619, 'Alfuzosin Tablet, 2.5mg, 5mg, 10mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(620, 'Doxazosin Tablet, 1mg, 2mg, 4mg, 8mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(621, 'Dutasteride Capsule, 0.5mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(622, 'Finasteride Tablet, 5mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(623, 'Prazosin Hydrochloride Tablet, 1 mg, 2 mg, 5 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(624, 'Tamsulosin Capsule, 0.4mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(625, 'Sevelamer hydrochloride Tablet: 400mg and 800mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(626, 'Amrinone Lactate Injection, 5mg/ml in 20ml ampoule', NULL, 0, '1', '', '', '', '', '', '', ''),
(627, 'Captopril Tablet, 12.5 mg, 25 mg, 50 mg, 100 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(628, 'Digoxin Elixir, 0.05 mg/ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(629, 'Digoxin                                                                                    Injection, 0.1 mg/ml in 1 ml ampoule; 0.25 mg/ml in 2 ml ampoule', NULL, 0, '1', '', '', '', '', '', '', ''),
(630, 'Digoxin                                                                                     Tablet, 0.25 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(631, 'Enalapril Maleate Tablet, 2.5 mg, 5 mg, 10 mg, 20 mg, 40 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(632, 'Enalapril Maleate + Hydrochlorothiazide Tablet, 10 mg + 25 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(633, 'Hydralazine Tablet, 10mg, 25mg, 50mg, 100mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(634, 'Hydralazine Powder for injection, 20mg/ml in 1 ml ampoule', NULL, 0, '1', '', '', '', '', '', '', ''),
(635, 'Hydralazine +Isosorbide Dinitrate Tablet, 37.5mg+20mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(636, 'Isosorbide Dinitrate Tablet, 5mg, 10mg, 20mg, 30mg, 40mg, 60mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(637, 'Isosorbide Dinitrate Sublingual Tablet, 2.5mg, 5mg, 10mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(638, 'Isosorbide Dinitrate Tablet/Capsule(s/r), 40mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(639, 'Lisinopril Tablet 2.5 mg, 5 mg, 10 mg, 20 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(640, 'Adenosine Injection 3mg/ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(641, 'Amiodarone Tablet, 100mg, 200 mg, 400mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(642, 'Amiodarone Injection, 50mg/ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(643, 'Bretylium Tosylate Injection, 50 mg/ml in 2 ml ampoule', NULL, 0, '1', '', '', '', '', '', '', ''),
(644, 'Isoproterenol Injection, 0.02mg/ml, 0.2mg/ml', NULL, 0, '1', '', '', '', '', '', '', ''),
(645, 'Lidocaine hydrochloride Injection, 5 mg/ml, 10 mg/ml, 20 mg/ml in 20 ml vial', NULL, 0, '1', '', '', '', '', '', '', ''),
(646, 'Metoprolol Tablet, 50 mg, 100 mg, 200 mg (s/r.)', NULL, 0, '1', '', '', '', '', '', '', ''),
(647, 'Metoprolol Injection, 1 mg/ml, 05ml/ml ', NULL, 0, '1', '', '', '', '', '', '', ''),
(648, 'Mexiletin Hydrochloride Capsules, 50 mg, 200 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(649, 'Mexiletin Hydrochloride Injection, 25 mg/ml, in 10 ml ampoule', NULL, 0, '1', '', '', '', '', '', '', ''),
(650, 'Phenytoin (Diphenylhydantoin sodium) Powder for injection, 250mg in vial', NULL, 0, '1', '', '', '', '', '', '', ''),
(651, 'Procainamide hydrochloride Injection, 100 mg/ml, 10-ml ampoule', NULL, 0, '1', '', '', '', '', '', '', ''),
(652, 'Procainamide hydrochloride Tablet, 250 mg,', NULL, 0, '1', '', '', '', '', '', '', ''),
(653, 'Propranolol Injection, 1 mg/ml in 1 ml ampoule', NULL, 0, '1', '', '', '', '', '', '', ''),
(654, 'Propranolol  Tablet, 10 mg, 40 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(655, 'Quinidine sulphate Tablet, 200 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(656, 'Sotalol Tablet, 80mg, 120mg, 160mg, 240mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(657, 'Verapamil Hydrochloride Injection, 2.5 mg/ml in 2 ml ampoule ', NULL, 0, '1', '', '', '', '', '', '', ''),
(658, 'Verapamil Hydrochloride Tablets, 40 mg, 80 mg, 120 mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(659, 'Atorvastatin Tablet, 10 mg, 20mg, 40mg, 80mg', NULL, 0, '1', '', '', '', '', '', '', ''),
(660, 'Cholestyramine Powder, 4 g in 9g sachet', NULL, 0, '1', '', '', '', '', '', '', ''),
(661, 'Ezetimibe Tablet, 10mg', NULL, 0, '1', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `educationallevel`
--

DROP TABLE IF EXISTS `educationallevel`;
CREATE TABLE IF NOT EXISTS `educationallevel` (
  `educationalLevelId` int(11) NOT NULL AUTO_INCREMENT,
  `educationLevelName` varchar(200) NOT NULL,
  `status` enum('active','disabled') NOT NULL DEFAULT 'active',
  `addedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `addedById` int(11) NOT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`educationalLevelId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `educationallevel`
--

INSERT INTO `educationallevel` (`educationalLevelId`, `educationLevelName`, `status`, `addedDate`, `addedById`, `isDeleted`) VALUES
(1, 'BSc', 'active', '2019-06-25 09:30:23', 9, 0),
(2, 'MBA', 'active', '2019-06-25 09:30:44', 9, 0),
(3, 'MA', 'active', '2019-06-25 09:30:53', 9, 0),
(4, 'MSc', 'active', '2019-06-25 09:31:06', 9, 0),
(5, 'Diploma', 'active', '2019-06-25 09:52:42', 9, 0),
(6, '12th', 'active', '2019-06-25 09:57:47', 9, 0),
(7, 'PHD', 'active', '2019-06-26 14:52:35', 9, 0),
(8, 'MD', 'active', '2019-09-02 09:25:07', 1, 0),
(9, '10th', 'active', '2023-06-26 07:26:38', 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `licence`
--

DROP TABLE IF EXISTS `licence`;
CREATE TABLE IF NOT EXISTS `licence` (
  `licenceId` int(11) NOT NULL AUTO_INCREMENT,
  `licenceText` longtext NOT NULL,
  `addedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `addedBy` int(11) NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `Version` float NOT NULL,
  PRIMARY KEY (`licenceId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `licence`
--

INSERT INTO `licence` (`licenceId`, `licenceText`, `addedDate`, `addedBy`, `Status`, `Version`) VALUES
(1, 'This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement This is the licence Agreement ', '2019-06-24 11:43:45', 1, 'Active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loginhistory`
--

DROP TABLE IF EXISTS `loginhistory`;
CREATE TABLE IF NOT EXISTS `loginhistory` (
  `logId` int(11) NOT NULL AUTO_INCREMENT,
  `usersId` int(11) NOT NULL,
  `browserDetails` varchar(250) NOT NULL,
  `ipaddress` varchar(20) NOT NULL,
  `osType` varchar(100) NOT NULL,
  `deviceType` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  PRIMARY KEY (`logId`)
) ENGINE=InnoDB AUTO_INCREMENT=575 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginhistory`
--

INSERT INTO `loginhistory` (`logId`, `usersId`, `browserDetails`, `ipaddress`, `osType`, `deviceType`, `location`, `loginTime`, `latitude`, `longitude`) VALUES
(258, 22, 'Google Chrome ( Version77.0.3865.120 )', '::1', 'windows', 'Computer', '', '2019-10-17 10:23:01', 0, 0),
(259, 22, 'Google Chrome ( Version77.0.3865.120 )', '::1', 'windows', 'Computer', '', '2019-10-21 12:55:41', 0, 0),
(260, 22, 'Google Chrome ( Version77.0.3865.120 )', '::1', 'windows', 'Computer', '', '2019-10-21 13:21:01', 0, 0),
(261, 22, 'Google Chrome ( Version77.0.3865.120 )', '::1', 'windows', 'Computer', '', '2019-10-21 13:23:12', 0, 0),
(262, 22, 'Google Chrome ( Version77.0.3865.120 )', '::1', 'windows', 'Computer', '', '2019-10-25 10:25:50', 0, 0),
(263, 22, 'Google Chrome ( Version77.0.3865.120 )', '::1', 'windows', 'Computer', '', '2019-10-27 14:30:10', 0, 0),
(264, 22, 'Google Chrome ( Version78.0.3904.97 )', '::1', 'windows', 'Computer', '', '2019-11-12 15:02:55', 0, 0),
(265, 22, 'Google Chrome ( Version78.0.3904.97 )', '::1', 'windows', 'Computer', '', '2019-11-16 13:05:00', 0, 0),
(266, 22, 'Google Chrome ( Version78.0.3904.97 )', '::1', 'windows', 'Computer', '', '2019-11-18 14:11:47', 0, 0),
(267, 22, 'Google Chrome ( Version78.0.3904.108 )', '::1', 'windows', 'Computer', '', '2019-11-23 13:53:40', 0, 0),
(268, 26, 'Google Chrome ( Version78.0.3904.108 )', '::1', 'windows', 'Computer', '', '2019-11-23 13:54:18', 0, 0),
(269, 22, 'Google Chrome ( Version78.0.3904.108 )', '::1', 'windows', 'Computer', '', '2019-11-25 17:30:14', 0, 0),
(270, 22, 'Google Chrome ( Version78.0.3904.108 )', '::1', 'windows', 'Computer', '', '2019-12-09 13:24:33', 0, 0),
(271, 22, 'Google Chrome ( Version79.0.3945.79 )', '::1', 'windows', 'Computer', '', '2019-12-16 07:28:59', 0, 0),
(272, 22, 'Google Chrome ( Version79.0.3945.79 )', '::1', 'windows', 'Computer', '', '2019-12-17 12:55:42', 0, 0),
(273, 26, 'Google Chrome ( Version79.0.3945.79 )', '::1', 'windows', 'Computer', '', '2019-12-17 12:58:43', 0, 0),
(274, 26, 'Google Chrome ( Version79.0.3945.79 )', '::1', 'windows', 'Computer', '', '2019-12-18 13:58:34', 0, 0),
(275, 26, 'Google Chrome ( Version79.0.3945.117 )', '::1', 'windows', 'Computer', '', '2020-01-12 09:06:01', 0, 0),
(276, 22, 'Google Chrome ( Version79.0.3945.117 )', '::1', 'windows', 'Computer', '', '2020-01-13 12:03:31', 0, 0),
(277, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-16 12:59:18', 0, 0),
(278, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-21 13:05:03', 0, 0),
(279, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-21 14:12:50', 0, 0),
(280, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-21 14:15:43', 0, 0),
(281, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-21 15:10:50', 0, 0),
(282, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-21 15:18:49', 0, 0),
(283, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 05:38:29', 0, 0),
(284, 22, '', '', '', '', '', '2023-06-22 13:29:49', 0, 0),
(285, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 13:40:09', 0, 0),
(286, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 14:08:32', 0, 0),
(287, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 14:10:39', 0, 0),
(288, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 14:12:26', 0, 0),
(289, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 14:12:46', 0, 0),
(290, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 14:15:00', 0, 0),
(291, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 14:17:50', 0, 0),
(292, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 14:23:00', 0, 0),
(293, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 14:23:50', 0, 0),
(294, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 14:24:08', 0, 0),
(295, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 14:28:09', 0, 0),
(296, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 15:04:09', 0, 0),
(297, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 15:21:45', 0, 0),
(298, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 15:51:42', 0, 0),
(299, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 15:55:30', 0, 0),
(300, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 15:55:43', 0, 0),
(301, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-22 15:58:13', 0, 0),
(302, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 05:48:26', 0, 0),
(303, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 06:31:17', 0, 0),
(304, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 06:44:23', 0, 0),
(305, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 06:44:47', 0, 0),
(306, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 06:58:17', 0, 0),
(307, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 07:09:53', 0, 0),
(308, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 07:34:53', 0, 0),
(309, 24, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 07:35:15', 0, 0),
(310, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 08:07:19', 0, 0),
(311, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 08:08:06', 0, 0),
(312, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 08:56:05', 0, 0),
(313, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 09:59:42', 0, 0),
(314, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 10:07:40', 0, 0),
(315, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 10:33:34', 0, 0),
(316, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 10:34:45', 0, 0),
(317, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 13:08:10', 0, 0),
(318, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 13:08:28', 0, 0),
(319, 24, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 13:09:09', 0, 0),
(320, 24, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 13:21:35', 0, 0),
(321, 24, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 13:32:16', 0, 0),
(322, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 13:32:42', 0, 0),
(323, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 13:49:48', 0, 0),
(324, 24, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 14:34:29', 0, 0),
(325, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 14:34:50', 0, 0),
(326, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 15:10:55', 0, 0),
(327, 30, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 16:25:10', 0, 0),
(328, 25, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 16:25:25', 0, 0),
(329, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 16:25:37', 0, 0),
(330, 30, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 16:26:26', 0, 0),
(331, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-23 16:28:52', 0, 0),
(332, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-24 06:37:08', 0, 0),
(333, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-24 07:51:23', 0, 0),
(334, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-24 07:55:23', 0, 0),
(335, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-24 08:53:55', 0, 0),
(336, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-24 08:57:38', 0, 0),
(337, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-24 08:57:51', 0, 0),
(338, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-24 09:16:53', 0, 0),
(339, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-24 09:22:59', 0, 0),
(340, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-24 09:24:39', 0, 0),
(341, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-24 09:25:08', 0, 0),
(342, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-24 14:01:50', 0, 0),
(343, 33, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-24 14:04:56', 0, 0),
(344, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-24 14:41:36', 0, 0),
(345, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-26 07:49:24', 0, 0),
(346, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-26 07:49:33', 0, 0),
(347, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-26 08:47:25', 0, 0),
(348, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 07:41:47', 0, 0),
(349, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 07:41:58', 0, 0),
(350, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 07:55:55', 0, 0),
(351, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 08:16:20', 0, 0),
(352, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 08:16:31', 0, 0),
(353, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 08:21:40', 0, 0),
(354, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 08:23:44', 0, 0),
(355, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 08:32:13', 0, 0),
(356, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 08:32:31', 0, 0),
(357, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 08:33:51', 0, 0),
(358, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 08:34:32', 0, 0),
(359, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 08:38:31', 0, 0),
(360, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 08:39:45', 0, 0),
(361, 30, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 08:42:41', 0, 0),
(362, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 08:44:01', 0, 0),
(363, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 09:01:16', 0, 0),
(364, 34, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 09:44:04', 0, 0),
(365, 34, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 09:47:17', 0, 0),
(366, 34, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 09:58:36', 0, 0),
(367, 30, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 10:05:45', 0, 0),
(368, 34, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 10:15:37', 0, 0),
(369, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 10:16:43', 0, 0),
(370, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 11:10:47', 0, 0),
(371, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 11:12:39', 0, 0),
(372, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 11:36:06', 0, 0),
(373, 34, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 11:38:48', 0, 0),
(374, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 11:43:20', 0, 0),
(375, 35, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 11:48:44', 0, 0),
(376, 35, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 11:53:53', 0, 0),
(377, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 12:17:44', 0, 0),
(378, 36, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 12:18:16', 0, 0),
(379, 36, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 12:30:23', 0, 0),
(380, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 12:36:19', 0, 0),
(381, 37, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 12:37:55', 0, 0),
(382, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 12:51:25', 0, 0),
(383, 38, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 12:52:08', 0, 0),
(384, 38, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 13:04:08', 0, 0),
(385, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 13:13:38', 0, 0),
(386, 39, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 13:16:05', 0, 0),
(387, 37, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-28 13:23:57', 0, 0),
(388, 37, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 05:16:28', 0, 0),
(389, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 05:18:41', 0, 0),
(390, 30, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 05:29:53', 0, 0),
(391, 33, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 05:32:32', 0, 0),
(392, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 05:36:51', 0, 0),
(393, 39, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 05:53:01', 0, 0),
(394, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 05:56:59', 0, 0),
(395, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 06:28:02', 0, 0),
(396, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 06:37:15', 0, 0),
(397, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 06:38:13', 0, 0),
(398, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 06:57:36', 0, 0),
(399, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 07:25:08', 0, 0),
(400, 38, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 08:06:08', 0, 0),
(401, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 08:30:32', 0, 0),
(402, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 08:36:19', 0, 0),
(403, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 09:08:48', 0, 0),
(404, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 09:40:42', 0, 0),
(405, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 11:21:53', 0, 0),
(406, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 11:38:38', 0, 0),
(407, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 12:12:55', 0, 0),
(408, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 12:30:09', 0, 0),
(409, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 12:31:46', 0, 0),
(410, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 12:32:23', 0, 0),
(411, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 12:45:57', 0, 0),
(412, 40, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 13:31:45', 0, 0),
(413, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 13:37:15', 0, 0),
(414, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 13:37:42', 0, 0),
(415, 30, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 13:38:55', 0, 0),
(416, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 13:44:48', 0, 0),
(417, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 14:06:48', 0, 0),
(418, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 14:25:51', 0, 0),
(419, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 14:30:16', 0, 0),
(420, 30, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 14:45:26', 0, 0),
(421, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 14:46:39', 0, 0),
(422, 40, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-29 14:49:18', 0, 0),
(423, 40, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 05:13:03', 0, 0),
(424, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 05:14:17', 0, 0),
(425, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 05:30:40', 0, 0),
(426, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 05:54:03', 0, 0),
(427, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 07:27:37', 0, 0),
(428, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 07:55:02', 0, 0),
(429, 40, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 07:58:36', 0, 0),
(430, 30, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 08:02:22', 0, 0),
(431, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 08:02:48', 0, 0),
(432, 30, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 08:03:25', 0, 0),
(433, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 08:56:32', 0, 0),
(434, 30, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 09:21:43', 0, 0),
(435, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 09:32:44', 0, 0),
(436, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 11:37:03', 0, 0),
(437, 33, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 12:36:29', 0, 0),
(438, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 12:54:39', 0, 0),
(439, 40, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 12:55:53', 0, 0),
(440, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 13:06:58', 0, 0),
(441, 40, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 13:09:28', 0, 0),
(442, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 13:11:15', 0, 0),
(443, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 14:58:14', 0, 0),
(444, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 15:01:04', 0, 0),
(445, 40, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 15:01:17', 0, 0),
(446, 39, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 15:01:37', 0, 0),
(447, 33, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 15:01:50', 0, 0),
(448, 38, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 15:02:06', 0, 0),
(449, 30, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 15:14:40', 0, 0),
(450, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-06-30 15:16:07', 0, 0),
(451, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 06:05:30', 0, 0),
(452, 39, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 06:06:10', 0, 0),
(453, 39, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 06:28:22', 0, 0),
(454, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 06:28:30', 0, 0),
(455, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 07:43:52', 0, 0),
(456, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 07:54:41', 0, 0),
(457, 40, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 07:57:39', 0, 0),
(458, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 07:59:45', 0, 0),
(459, 40, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 08:19:14', 0, 0),
(460, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 08:22:47', 0, 0),
(461, 40, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 08:23:07', 0, 0),
(462, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 08:26:06', 0, 0),
(463, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 08:32:04', 0, 0),
(464, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 08:33:30', 0, 0),
(465, 40, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 08:55:04', 0, 0),
(466, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 08:56:23', 0, 0),
(467, 40, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 08:56:56', 0, 0),
(468, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 08:57:21', 0, 0),
(469, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 11:12:55', 0, 0),
(470, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 11:32:03', 0, 0),
(471, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 11:49:11', 0, 0),
(472, 42, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 11:50:00', 0, 0),
(473, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 12:42:41', 0, 0),
(474, 42, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 12:44:04', 0, 0),
(475, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-01 13:16:31', 0, 0),
(476, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-03 10:58:20', 0, 0),
(477, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-03 11:06:41', 0, 0),
(478, 30, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-03 11:30:39', 0, 0),
(479, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-03 12:02:12', 0, 0),
(480, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-03 12:59:56', 0, 0),
(481, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-04 08:23:36', 0, 0),
(482, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-04 08:50:03', 0, 0),
(483, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-04 08:50:20', 0, 0),
(484, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-04 11:58:59', 0, 0),
(485, 30, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-04 12:21:02', 0, 0),
(486, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-04 13:51:22', 0, 0),
(487, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-04 13:56:09', 0, 0),
(488, 30, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-04 14:24:56', 0, 0),
(489, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-04 14:51:15', 0, 0),
(490, 40, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-04 14:51:35', 0, 0),
(491, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-04 14:52:39', 0, 0),
(492, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-05 05:29:57', 0, 0),
(493, 30, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-05 06:06:59', 0, 0),
(494, 40, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-05 06:13:30', 0, 0),
(495, 30, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-05 06:18:00', 0, 0),
(496, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-05 06:19:00', 0, 0),
(497, 33, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-05 06:31:20', 0, 0),
(498, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-05 06:33:08', 0, 0),
(499, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-06 06:29:10', 0, 0),
(500, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-06 06:52:43', 0, 0),
(501, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-06 07:00:39', 0, 0),
(502, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-06 07:06:46', 0, 0),
(503, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-06 07:07:48', 0, 0),
(504, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-06 07:20:22', 0, 0),
(505, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-06 07:20:31', 0, 0),
(506, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-06 10:35:27', 0, 0),
(507, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-06 11:19:05', 0, 0),
(508, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-06 12:29:07', 0, 0),
(509, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-06 13:56:56', 0, 0),
(510, 24, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-06 13:57:18', 0, 0),
(511, 24, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-06 14:06:30', 0, 0),
(512, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-06 14:06:47', 0, 0),
(513, 24, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-06 14:09:44', 0, 0),
(514, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 05:41:50', 13.484032, 39.4625024),
(515, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 05:47:36', 13.484032, 39.4625024),
(516, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 05:49:17', 13.484032, 39.4625024),
(517, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 06:08:58', 13.484032, 39.4625024),
(518, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 06:45:52', 13.484032, 39.4625024),
(519, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 06:46:13', 13.484032, 39.4625024),
(520, 33, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 06:51:23', 13.484032, 39.4625024),
(521, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 06:51:45', 13.484032, 39.4625024),
(522, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 06:57:22', 13.484032, 39.4625024),
(523, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 07:13:43', 13.484032, 39.4625024),
(524, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 07:22:35', 13.484032, 39.4625024),
(525, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 06:52:11', 40.830167, -74.1298684),
(526, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 06:53:21', 40.830167, -74.1298684),
(527, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'linux', 'Mobile', '', '2023-07-07 07:11:10', 40.830167, -74.1298684),
(528, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 07:20:28', 40.830167, -74.1298684),
(529, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 08:53:09', 40.830167, -74.1298684),
(530, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 11:03:52', 13.484032, 39.4625024),
(531, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 11:12:15', 13.489300087301043, 39.469973859461945),
(532, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 11:56:10', 41.0895249, -73.8419063),
(533, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 12:13:14', 13.4891298, 39.4698384),
(534, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 13:23:43', 41.0895249, -73.8419063),
(535, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 13:27:00', 41.0895249, -73.8419063),
(536, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-07 14:02:17', 41.0895249, -73.8419063),
(537, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-08 06:49:05', 13.4891204, 39.4698391),
(538, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 06:04:06', 13.489506069355576, 39.46989366208149),
(539, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 06:06:16', 13.489480755587003, 39.4698839271796),
(540, 40, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 06:08:20', 13.489441143596668, 39.46993973341574),
(541, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 06:09:20', 13.489457524629303, 39.470024328757496),
(542, 40, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 06:10:15', 13.48942051384595, 39.46991684565391),
(543, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 07:08:09', 13.489493956619784, 39.46993929490564),
(544, 40, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 07:09:02', 13.489412996086772, 39.469926762739966),
(545, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 07:59:30', 13.489355200294977, 39.469937123890304),
(546, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 08:06:43', 13.489490057142499, 39.47002486988232),
(547, 23, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 08:23:09', 13.489456352377218, 39.469995145057126),
(548, 42, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 08:23:22', 13.489456352377218, 39.469995145057126),
(549, 42, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 08:24:04', 13.489317340305403, 39.46997167866275),
(550, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 08:29:45', 13.489233326842317, 39.46995271527268),
(551, 42, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 08:30:49', 13.489233326842317, 39.46995271527268),
(552, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 08:31:13', 13.489233326842317, 39.46995271527268),
(553, 42, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 08:31:47', 13.489550281328906, 39.470009328156806),
(554, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 08:32:39', 13.489490057142499, 39.47002486988232),
(555, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 11:58:37', 40.830167, -74.1298684),
(556, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 12:01:41', 40.830167, -74.1298684),
(557, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 12:14:50', 40.830167, -74.1298684),
(558, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 12:28:51', 40.830167, -74.1298684),
(559, 42, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 12:29:15', 40.830167, -74.1298684),
(560, 42, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 12:32:23', 40.830167, -74.1298684),
(561, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 12:41:10', 13.48949052272532, 39.470009242963215),
(562, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 13:01:49', 13.489396424184664, 39.46996544878613),
(563, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 14:07:02', 40.830167, -74.1298684),
(564, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-10 14:07:54', 40.830167, -74.1298684),
(565, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-11 06:05:00', 13.489244669193479, 39.47000639218447),
(566, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-11 08:05:01', 13.489143054153981, 39.46990773409005),
(567, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-11 08:05:59', 13.489526700253755, 39.47005506759902),
(568, 42, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-11 08:16:31', 13.48939715313418, 39.46997324422121),
(569, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-11 08:17:03', 13.489457524629303, 39.470024328757496),
(570, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-11 08:49:32', 13.48941829155141, 39.469922863412634),
(571, 42, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-11 09:09:15', 13.489339113262654, 39.46990945995119),
(572, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-11 09:57:35', 13.489541763488644, 39.47001536916102),
(573, 26, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-11 11:55:53', 13.489473655578099, 39.46995592708437),
(574, 22, 'Google Chrome ( Version114.0.0.0 )', '::1', 'windows', 'Computer', '', '2023-07-11 11:56:39', 13.489322973759279, 39.47001129237765);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `menusId` int(11) NOT NULL AUTO_INCREMENT,
  `menusVarName` varchar(50) NOT NULL,
  `menusTitle` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `canView` varchar(200) NOT NULL,
  PRIMARY KEY (`menusId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menusId`, `menusVarName`, `menusTitle`, `icon`, `canView`) VALUES
(1, 'hub', 'Hub', 'menu-icon fa fa-home', '1,2,3,4,5,6,9'),
(2, 'configurations', 'Configurations', 'menu-icon fa fa-briefcase', '5,9'),
(3, 'reports', 'Reports', 'menu-icon fa fa-file-o', '5');

-- --------------------------------------------------------

--
-- Table structure for table `nearbypharmacycache`
--

DROP TABLE IF EXISTS `nearbypharmacycache`;
CREATE TABLE IF NOT EXISTS `nearbypharmacycache` (
  `nearbyPharmacyCacheId` int(11) NOT NULL AUTO_INCREMENT,
  `pharmacyId` int(11) NOT NULL,
  `distance` double NOT NULL,
  `uploadedPrescriptionsId` int(11) NOT NULL,
  `released` int(11) DEFAULT NULL,
  `addedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`nearbyPharmacyCacheId`)
) ENGINE=InnoDB AUTO_INCREMENT=326 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nearbypharmacycache`
--

INSERT INTO `nearbypharmacycache` (`nearbyPharmacyCacheId`, `pharmacyId`, `distance`, `uploadedPrescriptionsId`, `released`, `addedDate`) VALUES
(316, 1, 10.22, 1, 0, '2019-11-23 11:58:01'),
(317, 11, 10.49, 1, 1, '2019-11-23 14:01:40'),
(318, 12, 11.58, 1, 0, '2019-11-23 11:58:01'),
(319, 1, 3.8, 13, 0, '2019-11-23 11:58:01'),
(320, 11, 4.1, 13, 0, '2019-11-23 11:58:01'),
(321, 1, 3.4, 14, 0, '2019-11-23 11:58:01'),
(322, 11, 3.14, 14, 0, '2019-11-23 11:58:01'),
(323, 12, 2.64, 14, 0, '2019-11-23 11:58:01'),
(324, 12, 5.2, 13, 0, '2019-11-23 12:00:01'),
(325, 12, 5.2, 13, 0, '2019-11-23 12:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `passwordreset`
--

DROP TABLE IF EXISTS `passwordreset`;
CREATE TABLE IF NOT EXISTS `passwordreset` (
  `passwordResetId` int(11) NOT NULL AUTO_INCREMENT,
  `randomValue` varchar(20) NOT NULL,
  `resetDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usersId` int(11) NOT NULL,
  `resetStatus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`passwordResetId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passwordreset`
--

INSERT INTO `passwordreset` (`passwordResetId`, `randomValue`, `resetDate`, `usersId`, `resetStatus`) VALUES
(1, 'jTMBOiwHxdhXSQ9', '2023-07-07 07:00:14', 37, 0),
(2, 'HXWPaFnAuK9g0ZF', '2023-07-07 07:05:29', 37, 0),
(3, 'tkkkKtUfsf2pYji', '2023-07-07 07:07:51', 37, 0),
(4, 'FSUKc7fuFjIDKFE', '2023-07-07 07:10:15', 37, 0),
(5, '5gsnHuREcEMaMdz', '2023-07-07 07:12:47', 37, 0),
(6, 'YdO4feviAdpxitX', '2023-07-07 07:13:54', 37, 0),
(7, 'yEbhoyd8EX9nK4W', '2023-07-07 12:35:54', 37, 0),
(8, 'ztvH8fOnSq8eEKw', '2023-07-07 13:15:02', 37, 0),
(9, 'I5ORpLOP9sADW6M', '2023-07-07 13:15:45', 37, 0),
(10, 'kTSirnzQYZS4iUU', '2023-07-07 13:16:43', 37, 0),
(11, '4FYITI5Syzn63KB', '2023-07-07 13:17:47', 37, 0);

-- --------------------------------------------------------

--
-- Table structure for table `patientindex`
--

DROP TABLE IF EXISTS `patientindex`;
CREATE TABLE IF NOT EXISTS `patientindex` (
  `patientIndexId` int(11) NOT NULL AUTO_INCREMENT,
  `patientId` int(11) NOT NULL,
  `MPI` int(11) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`patientIndexId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientindex`
--

INSERT INTO `patientindex` (`patientIndexId`, `patientId`, `MPI`, `createdDate`) VALUES
(1, 22, 92, '2019-07-04 10:29:51'),
(2, 25, 93, '2019-07-05 15:52:21'),
(3, 27, 94, '2019-07-06 15:23:54'),
(4, 24, 95, '2019-07-13 09:26:59'),
(5, 23, 96, '2019-07-16 14:24:05'),
(6, 29, 97, '2019-07-17 10:51:35'),
(7, 30, 98, '2019-07-17 10:58:39'),
(8, 29, 99, '2019-07-25 13:15:25'),
(9, 59, 100, '2019-09-20 09:08:46'),
(10, 41, 101, '2023-07-01 07:57:10');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacistinfo`
--

DROP TABLE IF EXISTS `pharmacistinfo`;
CREATE TABLE IF NOT EXISTS `pharmacistinfo` (
  `pharmacistInfoId` int(11) NOT NULL AUTO_INCREMENT,
  `roleRequestId` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `educationalLevelId` int(11) NOT NULL,
  `graduatedFrom` varchar(500) NOT NULL,
  `graduationYear` int(11) NOT NULL,
  `licenceNo` varchar(100) NOT NULL,
  `licenceExpirationDate` date NOT NULL,
  `qualification` enum('Senior','Junior','Chief','Expert') NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pharmacistInfoId`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacistinfo`
--

INSERT INTO `pharmacistinfo` (`pharmacistInfoId`, `roleRequestId`, `usersId`, `educationalLevelId`, `graduatedFrom`, `graduationYear`, `licenceNo`, `licenceExpirationDate`, `qualification`, `isDeleted`) VALUES
(7, 5, 22, 3, 'Mekelle University', 1904, '4433', '2019-07-25', 'Junior', 0),
(8, 8, 26, 4, 'Mekelle University', 2012, '12', '2020-02-11', 'Chief', 0),
(9, 9, 30, 1, 'Mekelle University', 2018, 'LC-1235', '2025-10-20', 'Senior', 0),
(10, 1, 31, 4, 'Mekelle University', 2, '123456', '2023-06-28', 'Junior', 0),
(11, 3, 33, 1, 'Mekelle University', 12, '78364', '2023-06-28', 'Senior', 0),
(12, 5, 26, 2, 'Mekelle University', 1990, '8798', '2023-07-08', 'Senior', 0),
(13, 7, 34, 1, 'Mekelle University', 123435, '123456', '2023-07-08', 'Senior', 0),
(14, 10, 22, 1, 'Mekelle University', 2020, '123456', '2023-07-08', 'Senior', 0),
(15, 12, 35, 1, 'Mekelle University', 1990, '23453', '2023-07-08', 'Senior', 0),
(16, 14, 36, 1, 'Mekelle University', 2001, '928388', '2023-07-08', 'Senior', 0),
(17, 17, 37, 1, 'Mekelle University', 2003, '463758', '2023-07-08', 'Senior', 0),
(18, 20, 38, 4, 'Mekelle University', 2000, '89278', '2023-07-08', 'Senior', 0),
(19, 22, 39, 1, 'Mekelle University', 2002, '8974', '2023-07-08', 'Senior', 0),
(20, 26, 40, 1, 'Mekelle University', 2023, '2928383', '2023-07-08', 'Senior', 0),
(21, 27, 23, 1, 'Mekelle University', 2000, '82790', '2023-07-08', 'Senior', 0),
(22, 34, 42, 1, 'Mekelle University', 2019, '3748656', '2023-07-29', 'Senior', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacistmanagement`
--

DROP TABLE IF EXISTS `pharmacistmanagement`;
CREATE TABLE IF NOT EXISTS `pharmacistmanagement` (
  `pharmacyManagementId` int(11) NOT NULL AUTO_INCREMENT,
  `usersId` int(11) NOT NULL,
  `pharmacyId` int(11) NOT NULL,
  `managedById` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `actionDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pharmacyManagementId`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacistmanagement`
--

INSERT INTO `pharmacistmanagement` (`pharmacyManagementId`, `usersId`, `pharmacyId`, `managedById`, `status`, `actionDate`) VALUES
(48, 42, 17, 26, 'Active', '2023-07-10 08:11:02');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

DROP TABLE IF EXISTS `pharmacy`;
CREATE TABLE IF NOT EXISTS `pharmacy` (
  `pharmacyId` int(11) NOT NULL AUTO_INCREMENT,
  `pharmacyName` varchar(200) DEFAULT NULL,
  `pharmacyType` varchar(100) DEFAULT NULL,
  `countryId` int(11) DEFAULT '0',
  `stateId` int(11) DEFAULT '0',
  `zoneId` int(11) DEFAULT '0',
  `woredaId` int(11) DEFAULT '0',
  `kebelle` varchar(150) DEFAULT NULL,
  `streetNumber` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `latitude` double DEFAULT '0',
  `longitude` double DEFAULT '0',
  `licenceNumber` varchar(200) DEFAULT NULL,
  `registrationNumber` varchar(200) DEFAULT NULL,
  `tinNumber` varchar(25) DEFAULT NULL,
  `addedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `registeredById` int(11) DEFAULT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0',
  `status` enum('Active','Disabled','Pending') NOT NULL DEFAULT 'Pending',
  `approval` enum('Active','Disabled','Pending') NOT NULL DEFAULT 'Pending',
  `approvedById` int(11) DEFAULT '0',
  `approvedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `openingAt` time NOT NULL,
  `closingAt` time NOT NULL,
  PRIMARY KEY (`pharmacyId`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`pharmacyId`, `pharmacyName`, `pharmacyType`, `countryId`, `stateId`, `zoneId`, `woredaId`, `kebelle`, `streetNumber`, `email`, `phoneNumber`, `latitude`, `longitude`, `licenceNumber`, `registrationNumber`, `tinNumber`, `addedDate`, `registeredById`, `isDeleted`, `status`, `approval`, `approvedById`, `approvedDate`, `openingAt`, `closingAt`) VALUES
(11, 'Hop', 'Pharmacy', 1, 1, 1, 1, '11', 'Str-002', 'hope@gmail.com', '+25914194452', 13.509937878067033, 39.48537439188988, '12345', '42343', '', '2023-07-05 06:18:50', 26, 0, 'Disabled', 'Pending', 22, '2023-07-05 06:18:50', '00:00:00', '00:00:00'),
(12, 'Hope-2', 'Pharmacy', 1, 1, 1, 1, '15', 'Godena Harnet', 'rezene@all.com', '+251914194450', 13.504902118620969, 39.47658061981201, '123456', '6745634', '', '2023-07-05 06:18:50', 26, 0, 'Disabled', 'Pending', 22, '2023-07-05 06:18:50', '00:00:00', '00:00:00'),
(16, 'Solomon', 'Drug Shop', 1, 1, 1, 1, '02', 'Sol Street', 'solomon@gmail.com', '0920678988', 13.506676761928142, 39.42402617187497, 'Lc-12346546', '123324', '85734985', '2019-11-25 17:38:03', 26, 0, 'Pending', 'Disabled', 22, '2019-11-25 17:38:03', '00:00:00', '00:00:00'),
(17, 'semere pharmacy', 'Pharmacy', 1, 1, 1, 1, 'lachi', '27738298s', 'semere@gmail.com', '0923839390', 13.487274366913034, 39.467909977987325, '3-0987657890-3', '88383838', '876567890990', '2023-07-01 08:49:06', 26, 0, 'Active', 'Active', 22, '2023-07-01 08:49:06', '00:00:00', '00:00:00'),
(18, 'Haben Drugshop', 'Drug Shop', 1, 1, 1, 1, 'lachi', '27738211', 'habu@gmail.com', '0910388773', 13.485700263634353, 39.47527705177421, '3-0987657890-33', '98780989', '876567890990-098', '2023-07-04 14:24:15', 26, 0, 'Active', 'Active', 22, '2023-07-04 14:24:15', '00:00:00', '00:00:00'),
(19, 'Philimon Pharmacy', 'Pharmacy', 1, 1, 1, 1, '16', '277382980', 'habu@gmail.com', '0910388773', 14.16284101179997, 38.893894126738005, '3-0987657890-3-4', '987809', '8890990-098', '2023-07-10 06:10:49', 26, 0, 'Active', 'Active', 22, '2023-07-10 06:10:49', '00:00:00', '00:00:00'),
(20, 'Danayt ', 'Drug Shop', 1, 1, 1, 1, '16', '27738298s', 'dana@gmail.com', '0923839390', 14.130987560418005, 38.74685226611788, '3-0987657890-3', '98780989', '87656789', '2023-07-04 10:59:39', 42, 0, 'Active', 'Active', 22, '2023-07-04 10:59:39', '00:00:00', '00:00:00'),
(21, 'New Life', 'Pharmacy', 1, 1, 1, 6, '05', '27', 'dana@gmail.com', '0912324847', 13.487347903525961, 39.47235776837796, '1234567', '9878-02-20323', '87656789-2039', '2023-07-03 12:07:54', 23, 0, 'Pending', 'Pending', 0, '2023-07-03 12:07:54', '00:00:00', '00:00:00'),
(22, 'Sheger', 'Pharmacy', 1, 12, 89, 1025, '12', '12312', 'danaa@gmail.com', '+251910388779', 8.9860817353819, 38.80899284346277, '290893786', '2387-239', '128738', '2023-07-10 08:31:29', 42, 0, 'Active', 'Active', 22, '2023-07-10 08:31:29', '00:00:00', '00:00:00'),
(23, 'Addis Ababa City Public', 'Pharmacy', 1, 12, 89, 1030, 'kebelle 12', '2PJP+2WH', 'addispharma@gmail.com', '0923839394', 9.029345352460613, 38.75464033522621, '1234567', '88383838', '876567890990-098', '2023-07-10 12:15:12', 26, 0, 'Active', 'Active', 22, '2023-07-10 12:15:12', '00:00:00', '00:00:00'),
(34, 'Stadium', 'Pharmacy', 1, 12, 89, 1026, '12', '12312', 'stadiumPharma@gmail.com', '+251910388779', 8.956845947588823, 38.78201536119179, '938765', '2387-239', '128738', '2023-07-11 08:06:14', 26, 0, 'Active', 'Active', 22, '2023-07-11 08:06:14', '02:00:00', '19:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacyapprovallog`
--

DROP TABLE IF EXISTS `pharmacyapprovallog`;
CREATE TABLE IF NOT EXISTS `pharmacyapprovallog` (
  `approvalLogId` int(11) NOT NULL AUTO_INCREMENT,
  `pharmacyId` int(11) NOT NULL,
  `fromStatus` varchar(120) NOT NULL,
  `toStatus` varchar(120) NOT NULL,
  `changedBy` int(11) NOT NULL,
  `Reason` varchar(500) NOT NULL,
  `approvalDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`approvalLogId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacyapprovallog`
--

INSERT INTO `pharmacyapprovallog` (`approvalLogId`, `pharmacyId`, `fromStatus`, `toStatus`, `changedBy`, `Reason`, `approvalDate`) VALUES
(1, 16, 'Pending', 'Active', 22, 'good', '2019-11-25 17:36:12'),
(2, 16, 'Active', 'Active', 22, 'denied', '2019-11-25 17:36:25'),
(3, 16, 'Active', 'Disabled', 22, 'Denied', '2019-11-25 17:38:03'),
(4, 15, 'Pending', 'Active', 22, 'yes', '2023-06-24 08:36:10'),
(5, 17, 'Pending', 'Active', 22, 'approved', '2023-06-29 12:32:06'),
(6, 19, 'Pending', 'Active', 22, 'approve', '2023-06-30 05:50:51'),
(7, 19, 'Pending', 'Active', 22, 'approve', '2023-06-30 05:52:14'),
(8, 19, 'Pending', 'Active', 22, 'approve', '2023-06-30 05:53:03'),
(9, 18, 'Pending', 'Active', 22, 'approve', '2023-06-30 07:53:55'),
(10, 20, 'Pending', 'Active', 22, 'approve', '2023-07-04 10:59:39'),
(11, 22, 'Pending', 'Active', 22, 'approve', '2023-07-10 08:31:29'),
(12, 23, 'Pending', 'Active', 22, 'approved', '2023-07-10 12:15:12'),
(13, 34, 'Pending', 'Active', 22, 'approved', '2023-07-11 08:06:14'),
(14, 24, 'Pending', 'Active', 22, 'approved', '2023-07-11 08:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacymanagement`
--

DROP TABLE IF EXISTS `pharmacymanagement`;
CREATE TABLE IF NOT EXISTS `pharmacymanagement` (
  `pharmacyLogId` int(11) NOT NULL AUTO_INCREMENT,
  `usersId` int(11) NOT NULL,
  `pharmacyId` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `actionDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pharmacyLogId`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacymanagement`
--

INSERT INTO `pharmacymanagement` (`pharmacyLogId`, `usersId`, `pharmacyId`, `status`, `actionDate`) VALUES
(1, 26, 12, 'Active', '2019-08-02 14:17:41'),
(2, 26, 11, 'Disabled', '2019-08-02 14:17:56'),
(3, 26, 12, 'Disabled', '2019-08-02 14:17:56'),
(4, 26, 11, 'Active', '2019-08-02 14:58:14'),
(5, 26, 12, 'Active', '2019-08-02 14:58:14'),
(6, 26, 11, 'Disabled', '2019-08-02 14:59:54'),
(7, 26, 12, 'Disabled', '2019-08-02 14:59:54'),
(8, 26, 12, 'Active', '2019-08-03 04:46:56'),
(9, 26, 12, 'Disabled', '2019-08-03 08:40:10'),
(10, 26, 11, 'Active', '2019-08-03 12:40:19'),
(11, 26, 11, 'Disabled', '2019-08-03 12:41:05'),
(12, 26, 11, 'Active', '2019-09-07 08:08:01'),
(13, 26, 12, 'Active', '2019-09-07 08:08:01'),
(14, 26, 19, 'Active', '2023-06-30 05:57:16'),
(15, 26, 18, 'Active', '2023-06-30 07:53:55'),
(16, 26, 19, 'Disabled', '2023-07-01 07:42:34'),
(17, 26, 11, 'Active', '2023-07-01 08:04:49'),
(18, 26, 12, 'Active', '2023-07-01 08:04:49'),
(19, 26, 17, 'Active', '2023-07-01 08:04:49'),
(20, 26, 18, 'Active', '2023-07-01 08:04:49'),
(21, 26, 19, 'Active', '2023-07-01 08:04:49'),
(22, 26, 11, 'Active', '2023-07-01 08:05:01'),
(23, 26, 12, 'Active', '2023-07-01 08:05:01'),
(24, 26, 17, 'Active', '2023-07-01 08:05:01'),
(25, 26, 18, 'Active', '2023-07-01 08:05:01'),
(26, 26, 19, 'Disabled', '2023-07-01 08:05:01'),
(27, 26, 11, 'Active', '2023-07-01 08:05:07'),
(28, 26, 12, 'Active', '2023-07-01 08:05:07'),
(29, 26, 17, 'Active', '2023-07-01 08:05:07'),
(30, 26, 18, 'Active', '2023-07-01 08:05:07'),
(31, 26, 19, 'Active', '2023-07-01 08:05:07'),
(32, 26, 11, 'Active', '2023-07-01 08:18:13'),
(33, 26, 12, 'Active', '2023-07-01 08:18:13'),
(34, 26, 17, 'Active', '2023-07-01 08:18:13'),
(35, 26, 18, 'Active', '2023-07-01 08:18:13'),
(36, 26, 19, 'Disabled', '2023-07-01 08:18:13'),
(37, 26, 11, 'Active', '2023-07-01 08:26:16'),
(38, 26, 12, 'Active', '2023-07-01 08:26:16'),
(39, 26, 17, 'Active', '2023-07-01 08:26:16'),
(40, 26, 18, 'Disabled', '2023-07-01 08:26:16'),
(41, 26, 19, 'Disabled', '2023-07-01 08:26:16'),
(42, 26, 11, 'Active', '2023-07-01 08:33:44'),
(43, 26, 12, 'Active', '2023-07-01 08:33:44'),
(44, 26, 17, 'Active', '2023-07-01 08:33:44'),
(45, 26, 18, 'Active', '2023-07-01 08:33:44'),
(46, 26, 19, 'Active', '2023-07-01 08:33:44'),
(47, 26, 11, 'Active', '2023-07-01 08:35:09'),
(48, 26, 12, 'Active', '2023-07-01 08:35:09'),
(49, 26, 17, 'Active', '2023-07-01 08:35:09'),
(50, 26, 18, 'Active', '2023-07-01 08:35:09'),
(51, 26, 19, 'Disabled', '2023-07-01 08:35:09'),
(52, 26, 11, 'Active', '2023-07-01 08:36:59'),
(53, 26, 12, 'Active', '2023-07-01 08:36:59'),
(54, 26, 17, 'Active', '2023-07-01 08:36:59'),
(55, 26, 18, 'Active', '2023-07-01 08:36:59'),
(56, 26, 19, 'Active', '2023-07-01 08:36:59'),
(57, 26, 11, 'Active', '2023-07-01 08:39:11'),
(58, 26, 12, 'Active', '2023-07-01 08:39:11'),
(59, 26, 17, 'Active', '2023-07-01 08:39:11'),
(60, 26, 18, 'Active', '2023-07-01 08:39:11'),
(61, 26, 19, 'Disabled', '2023-07-01 08:39:11'),
(62, 26, 11, 'Active', '2023-07-01 08:41:33'),
(63, 26, 12, 'Active', '2023-07-01 08:41:33'),
(64, 26, 17, 'Active', '2023-07-01 08:41:33'),
(65, 26, 18, 'Disabled', '2023-07-01 08:41:33'),
(66, 26, 19, 'Active', '2023-07-01 08:41:33'),
(67, 26, 17, 'Disabled', '2023-07-01 08:47:04'),
(68, 26, 19, 'Disabled', '2023-07-01 08:47:04'),
(69, 26, 17, 'Active', '2023-07-01 08:49:06'),
(70, 26, 18, 'Active', '2023-07-01 08:49:06'),
(71, 26, 19, 'Active', '2023-07-01 08:49:06'),
(72, 26, 19, 'Disabled', '2023-07-01 08:56:34'),
(73, 26, 18, 'Disabled', '2023-07-01 11:13:11'),
(74, 42, 20, 'Active', '2023-07-04 10:59:39'),
(75, 26, 18, 'Active', '2023-07-04 14:24:15'),
(76, 30, 11, 'Disabled', '2023-07-05 06:18:50'),
(77, 30, 12, 'Disabled', '2023-07-05 06:18:50'),
(78, 40, 19, 'Active', '2023-07-10 06:10:49'),
(79, 42, 22, 'Active', '2023-07-10 08:31:29'),
(80, 26, 23, 'Active', '2023-07-10 12:15:12'),
(81, 26, 34, 'Active', '2023-07-11 08:06:14'),
(82, 26, 24, 'Active', '2023-07-11 08:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacyusers`
--

DROP TABLE IF EXISTS `pharmacyusers`;
CREATE TABLE IF NOT EXISTS `pharmacyusers` (
  `pharmacyUsersId` int(11) NOT NULL AUTO_INCREMENT,
  `usersId` int(11) NOT NULL,
  `rolesId` int(11) NOT NULL,
  `pharmacyId` int(11) NOT NULL,
  `addedById` int(11) NOT NULL,
  `addedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(25) NOT NULL,
  PRIMARY KEY (`pharmacyUsersId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacyusers`
--

INSERT INTO `pharmacyusers` (`pharmacyUsersId`, `usersId`, `rolesId`, `pharmacyId`, `addedById`, `addedDate`, `status`) VALUES
(1, 26, 2, 11, 26, '2023-07-01 08:07:57', 'Disabled'),
(2, 30, 2, 11, 26, '2023-07-01 07:34:32', 'Active'),
(3, 30, 2, 12, 26, '2023-06-30 07:05:54', 'Active'),
(4, 40, 2, 17, 26, '2023-07-01 13:17:00', 'Disabled'),
(5, 40, 2, 12, 26, '2023-06-30 06:39:43', 'Disabled'),
(6, 40, 2, 19, 26, '2023-06-30 09:39:24', 'Active'),
(7, 40, 2, 18, 26, '2023-06-30 11:45:10', 'Active'),
(8, 30, 2, 19, 26, '2023-07-05 07:46:15', 'Active'),
(9, 33, 2, 18, 26, '2023-06-30 09:46:23', 'Active'),
(10, 33, 2, 12, 26, '2023-06-30 11:45:48', 'Active'),
(11, 42, 2, 17, 26, '2023-07-10 08:11:02', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `physicianinfo`
--

DROP TABLE IF EXISTS `physicianinfo`;
CREATE TABLE IF NOT EXISTS `physicianinfo` (
  `physicianInfoId` int(11) NOT NULL AUTO_INCREMENT,
  `roleRequestId` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `educationalLevelId` int(11) NOT NULL,
  `graduatedFrom` varchar(500) NOT NULL,
  `graduationYear` int(11) NOT NULL,
  `specializationId` int(11) NOT NULL,
  `HealthInstitutionName` varchar(100) NOT NULL,
  `licenceNo` varchar(100) NOT NULL,
  `licenceExpirationDate` date NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`physicianInfoId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `physicianinfo`
--

INSERT INTO `physicianinfo` (`physicianInfoId`, `roleRequestId`, `usersId`, `educationalLevelId`, `graduatedFrom`, `graduationYear`, `specializationId`, `HealthInstitutionName`, `licenceNo`, `licenceExpirationDate`, `isDeleted`) VALUES
(1, 2, 32, 1, 'Mekelle University', 1232, 8, 'Ayder General Hospital', '12345678', '2023-06-29', 0),
(2, 6, 34, 1, 'Mekelle University', 1999, 12, 'Mekelle Hospital', '8374746', '2023-07-08', 0),
(3, 11, 35, 1, 'Mekelle University', 1999, 16, 'Mekelle Hospital', '938383', '2023-07-08', 0),
(4, 13, 36, 1, 'Mekelle University', 1999, 55, 'Mekelle Hospital', '8765456789', '2023-07-08', 0),
(5, 16, 37, 1, 'Mekelle University', 1990, 55, 'Mekelle Hospital', '8729292', '2023-07-08', 0),
(6, 18, 38, 1, 'Mekelle University', 2002, 58, 'Mekelle Hospital', '892810', '2023-07-08', 0),
(7, 21, 39, 8, 'Mekelle University', 1990, 56, 'Mekelle Hospital', '0987', '2023-07-08', 0),
(8, 31, 33, 8, 'Mekelle University', 2023, 4, 'Mekelle Hospital', '8733773', '2023-07-08', 0),
(9, 33, 40, 1, 'Mekelle University', 1990, 4, 'Mekelle Hospital', '123748', '2023-07-08', 0),
(10, 35, 22, 2, 'Mekelle University', 2023, 10, 'Mekelle Hospital', '2343', '2023-07-29', 0),
(11, 37, 42, 1, 'Mekelle University', 2000, 16, 'Mekelle Hospital', '3847432', '2023-08-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `prescribeddrugs`
--

DROP TABLE IF EXISTS `prescribeddrugs`;
CREATE TABLE IF NOT EXISTS `prescribeddrugs` (
  `prescribedDrugsId` int(11) NOT NULL AUTO_INCREMENT,
  `prescriptionId` int(11) DEFAULT NULL,
  `drugsId` int(11) DEFAULT NULL,
  `drugsDose` double DEFAULT NULL,
  `drugsDoseUnit` varchar(25) DEFAULT NULL,
  `drugsFrequency` varchar(50) DEFAULT NULL,
  `drugsRoute` varchar(100) DEFAULT NULL,
  `drugsDuration` int(11) DEFAULT NULL,
  `drugsDurationUnit` varchar(25) DEFAULT NULL,
  `totalQty` double DEFAULT NULL,
  `qtyUnit` varchar(50) DEFAULT NULL,
  `drugsInstructions` varchar(100) DEFAULT NULL,
  `drugsAdditionalInstructions` varchar(500) DEFAULT NULL,
  `trackingNumber` varchar(50) DEFAULT NULL,
  `dispensedById` int(11) DEFAULT NULL,
  `pharmacyId` int(11) DEFAULT NULL,
  `pickedBy` varchar(100) DEFAULT NULL,
  `status` enum('Pending','Prescribed','Dispensed') NOT NULL DEFAULT 'Pending',
  `dispensedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` int(11) NOT NULL DEFAULT '0',
  `released` int(11) NOT NULL DEFAULT '0',
  `releasedById` int(11) NOT NULL DEFAULT '0',
  `releasedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`prescribedDrugsId`)
) ENGINE=InnoDB AUTO_INCREMENT=499 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescribeddrugs`
--

INSERT INTO `prescribeddrugs` (`prescribedDrugsId`, `prescriptionId`, `drugsId`, `drugsDose`, `drugsDoseUnit`, `drugsFrequency`, `drugsRoute`, `drugsDuration`, `drugsDurationUnit`, `totalQty`, `qtyUnit`, `drugsInstructions`, `drugsAdditionalInstructions`, `trackingNumber`, `dispensedById`, `pharmacyId`, `pickedBy`, `status`, `dispensedDate`, `isDeleted`, `released`, `releasedById`, `releasedDate`) VALUES
(486, 184, 464, 12, 'Tablet', 'Once a day', 'Nasal', 12, 'Day(s)', 144, 'Tablet', 'Before Meals', 'okla', '1234345', 26, 11, 'Rezene Hagos', 'Dispensed', '2023-06-30 09:49:55', 0, 0, 26, '2019-08-06 09:19:00'),
(487, 184, 444, 13, 'Tablet', 'Once a day', 'Nasal', 12, 'Day(s)', 156, 'Tablet', 'Empty stomach', 'okla', '1234', 26, 11, 'Rezene H', 'Dispensed', '2019-08-01 12:57:31', 0, 0, 0, '2019-08-06 09:19:00'),
(488, 185, 360, 2, 'Capsule', 'Once a day', 'Topical', 1, 'Day(s)', 2, 'Capsule', 'Before Meals', '', NULL, NULL, NULL, NULL, 'Prescribed', '2019-08-02 13:01:42', 0, 0, 0, '2019-08-06 09:19:00'),
(489, 185, 426, 2, 'Capsule', 'Once a day', 'Topical', 3, 'Day(s)', 6, 'Capsule', '', '', NULL, NULL, NULL, NULL, 'Prescribed', '2019-08-02 13:01:42', 0, 0, 0, '2019-08-06 09:19:00'),
(490, 186, 471, 5, 'Tablet', 'Immediately', 'Nasal', 5, 'Day(s)', 25, 'Tablet', 'Before Meals', '', '67', NULL, 12, '', 'Dispensed', '2019-09-18 12:45:01', 0, 0, 0, '2019-09-18 12:43:34'),
(491, 187, 464, 12, 'Tablet', 'Once a day', 'Nasal', 12, 'Day(s)', 144, 'Tablet', 'After meals', 'good as described', '', NULL, 0, 'rezene h', 'Dispensed', '2023-06-23 14:50:32', 0, 0, 0, '2023-06-23 14:21:12'),
(492, 188, 480, 12, 'Tablet', 'Once a day', 'Topical', 12, 'Day(s)', 144, 'Tablet', 'Empty stomach', 'all allowed', '1234', NULL, 0, 'Rezene H', 'Dispensed', '2023-06-23 14:49:45', 0, 0, 0, '2023-06-23 14:30:48'),
(493, 189, 444, 2, 'Tablet', 'Twice a day', 'Nasal', 3, 'Week(s)', 84, 'Tablet', 'After meals', 'dshdhshgdhghdvgsdsd', NULL, NULL, NULL, NULL, 'Prescribed', '2023-06-29 14:48:57', 0, 0, 0, '2023-06-29 14:48:47'),
(494, 190, 480, 12, 'Tablet', 'Once a day', 'Intrathecal', 2, 'Week(s)', 168, 'Tablet', 'Empty stomach', '2iquwshquieagxxuyashh', NULL, NULL, NULL, NULL, 'Prescribed', '2023-07-01 07:54:29', 0, 0, 0, '2023-07-01 07:44:30'),
(495, 191, 467, 4, 'Tablet', 'Once a day', 'Nasal', 4, 'Week(s)', 112, 'Tablet', 'Empty stomach', 'sdhigfisurg', '12343456', 40, 18, 'Abraham', 'Dispensed', '2023-07-01 07:58:21', 0, 0, 0, '2023-07-01 07:57:10'),
(496, 192, 619, 12, 'Tablet', 'Four times a day', 'Topical', 12, 'Month(s)', 17280, 'Tablet', 'Before Meals', 'eshgcusgvbjkdchdlfjgvsvdbdljfk', NULL, NULL, NULL, NULL, 'Prescribed', '2023-07-10 06:09:04', 0, 1, 40, '2023-07-10 06:07:04'),
(497, 192, 643, 23, 'Drop', 'Thrice a day', 'Intramuscular', 3, 'Week(s)', 1449, 'Drop', 'After meals', 'lerkhfiurhefnoiagebf8yerhsgefbois', '1265345', 40, 18, 'Abraham Belay', 'Dispensed', '2023-07-10 06:08:58', 0, 0, 0, '2023-07-10 06:07:37'),
(498, 193, 559, 12, 'ml', 'Once a day', 'Nasal', 120, 'Day(s)', 1440, 'ml', 'Empty stomach', '', NULL, NULL, NULL, NULL, 'Prescribed', '2023-07-10 08:02:30', 0, 0, 0, '2023-07-10 08:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

DROP TABLE IF EXISTS `prescription`;
CREATE TABLE IF NOT EXISTS `prescription` (
  `prescriptionId` int(11) NOT NULL AUTO_INCREMENT,
  `patientId` int(11) DEFAULT NULL,
  `prescriberId` int(11) DEFAULT NULL,
  `pharmacyId` int(11) DEFAULT NULL,
  `chiefCompliant` varchar(500) DEFAULT NULL,
  `diagnosis` varchar(500) DEFAULT NULL,
  `transactionId` varchar(25) DEFAULT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0',
  `pickedBy` varchar(100) DEFAULT NULL,
  `prescriptionDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Pending','Prescribed','Dispensed') NOT NULL DEFAULT 'Pending',
  `isReleased` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`prescriptionId`)
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`prescriptionId`, `patientId`, `prescriberId`, `pharmacyId`, `chiefCompliant`, `diagnosis`, `transactionId`, `isDeleted`, `pickedBy`, `prescriptionDate`, `status`, `isReleased`) VALUES
(184, 24, 23, 11, '', '', NULL, 0, NULL, '2019-07-31 14:04:19', 'Dispensed', 1),
(185, 25, 22, 0, '', '', NULL, 0, NULL, '2019-08-02 13:01:10', 'Prescribed', 0),
(186, 24, 23, 0, 'ill', '', NULL, 0, NULL, '2019-09-18 12:43:34', 'Dispensed', 0),
(187, 24, 22, 0, 'headache', 'HIV', NULL, 0, NULL, '2023-06-23 14:21:12', 'Dispensed', 0),
(188, 24, 22, 0, 'no compliant', 'coughing', NULL, 0, NULL, '2023-06-23 14:30:48', 'Dispensed', 0),
(189, 24, 23, 17, 'head ache and diarrhea', 'shjahdajdshdjsfgdhx', NULL, 0, NULL, '2023-06-29 14:48:47', 'Prescribed', 0),
(190, 24, 23, 18, 'dhhdhfjsfiu', 'sfgksydfkuamtfx', NULL, 0, NULL, '2023-07-01 07:44:30', 'Prescribed', 0),
(191, 41, 23, 18, 'fuhgiugytyardfuyjyrfieuj', 'kdfhgiuehfiaegflefsikfhj', NULL, 0, NULL, '2023-07-01 07:57:10', 'Dispensed', 0),
(192, 41, 23, 18, 'gefuyrghheedgiuwefpghvlkd.ah', 'hefiiusfbyguyfhhweifwegfuwwevjahddgvw', NULL, 0, NULL, '2023-07-10 06:07:04', 'Prescribed', 1),
(193, 24, 23, 1, '', '', NULL, 0, NULL, '2023-07-10 08:02:05', 'Prescribed', 0);

-- --------------------------------------------------------

--
-- Table structure for table `providersdocuments`
--

DROP TABLE IF EXISTS `providersdocuments`;
CREATE TABLE IF NOT EXISTS `providersdocuments` (
  `providersDocumentsId` int(11) NOT NULL AUTO_INCREMENT,
  `File_For` enum('Pharmacist','Physician','PharmacyOwner') NOT NULL,
  `folder` varchar(50) NOT NULL,
  `fileName` varchar(200) NOT NULL,
  `fileType` varchar(100) NOT NULL,
  `fileSize` varchar(11) NOT NULL,
  `fileDescription` varchar(150) DEFAULT NULL,
  `uploadedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usersId` int(11) NOT NULL,
  `other` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`providersDocumentsId`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `providersdocuments`
--

INSERT INTO `providersdocuments` (`providersDocumentsId`, `File_For`, `folder`, `fileName`, `fileType`, `fileSize`, `fileDescription`, `uploadedDate`, `usersId`, `other`) VALUES
(62, 'Physician', 'providersDocuments/physician', 'Dana12_o5gqq.png', 'png', '79723', NULL, '2023-07-10 14:06:45', 42, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registrationconfirmation`
--

DROP TABLE IF EXISTS `registrationconfirmation`;
CREATE TABLE IF NOT EXISTS `registrationconfirmation` (
  `registrationConfirmationId` int(11) NOT NULL AUTO_INCREMENT,
  `randomValue` varchar(20) NOT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usersId` int(11) NOT NULL,
  `usedStatus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`registrationConfirmationId`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrationconfirmation`
--

INSERT INTO `registrationconfirmation` (`registrationConfirmationId`, `randomValue`, `registrationDate`, `usersId`, `usedStatus`) VALUES
(88, '5MPYo7cbL3', '2019-11-23 15:17:47', 97, 0),
(89, 'NMa9hO5cUF', '2019-11-23 15:22:38', 98, 0),
(90, 'Tc9bjDXlcv', '2019-11-25 15:44:07', 99, 0),
(91, 'OOVwO6Qp0A', '2019-11-25 15:48:41', 100, 0),
(92, 'NPM3Ru9o54', '2019-11-25 16:49:39', 101, 0),
(93, 'JcMfKRZ3dd', '2019-11-25 17:08:54', 102, 0),
(94, 'e8aarNoHsx', '2019-11-25 17:16:59', 103, 0),
(95, 'tmipsrHi9a', '2023-06-24 13:35:06', 31, 0),
(96, 'Dhmw2Km9lD', '2023-06-24 13:39:15', 32, 0),
(97, 'KnpBJPtAiy', '2023-06-24 13:55:47', 33, 0),
(98, '1kXX3CvwVG', '2023-06-28 09:00:50', 34, 1),
(99, 'k6hHSFFCEa', '2023-06-28 11:40:44', 35, 1),
(100, 'CEFTSzOMXl', '2023-06-28 12:17:24', 36, 1),
(101, 'ViEMjrm0Ae', '2023-06-28 12:35:52', 37, 1),
(102, 'bPeSOxEiWE', '2023-06-28 12:49:59', 38, 0),
(103, 'kEcAlgofAx', '2023-06-28 13:13:08', 39, 0),
(104, 'opfyRC9noG', '2023-06-29 05:56:17', 40, 0),
(105, 'hoGwXazQx3', '2023-07-01 11:48:12', 42, 0);

-- --------------------------------------------------------

--
-- Table structure for table `releasemedication`
--

DROP TABLE IF EXISTS `releasemedication`;
CREATE TABLE IF NOT EXISTS `releasemedication` (
  `releaseMedicationId` int(11) NOT NULL AUTO_INCREMENT,
  `usersId` int(11) NOT NULL,
  `drugsId` int(11) NOT NULL,
  `pharmacyId` int(11) NOT NULL,
  `actionDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`releaseMedicationId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `releasemedication`
--

INSERT INTO `releasemedication` (`releaseMedicationId`, `usersId`, `drugsId`, `pharmacyId`, `actionDate`) VALUES
(2, 26, 464, 11, '2019-09-14 13:38:59'),
(3, 26, 478, 11, '2019-09-14 13:47:12'),
(4, 26, 462, 11, '2019-09-14 13:49:21'),
(5, 26, 462, 11, '2019-09-14 13:50:52'),
(6, 26, 462, 11, '2019-09-14 13:52:01'),
(7, 26, 462, 11, '2019-09-14 13:53:28'),
(8, 26, 464, 11, '2019-09-14 13:54:09'),
(9, 26, 462, 11, '2019-09-14 13:55:43'),
(10, 26, 462, 11, '2019-09-14 13:55:56'),
(11, 40, 619, 18, '2023-07-10 06:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `rolemenus`
--

DROP TABLE IF EXISTS `rolemenus`;
CREATE TABLE IF NOT EXISTS `rolemenus` (
  `roleMenusId` int(11) NOT NULL AUTO_INCREMENT,
  `rolesId` int(11) NOT NULL,
  `menusId` int(11) NOT NULL,
  `canView` int(11) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`roleMenusId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rolemenus`
--

INSERT INTO `rolemenus` (`roleMenusId`, `rolesId`, `menusId`, `canView`, `isDeleted`) VALUES
(1, 1, 1, 1, 0),
(2, 1, 2, 0, 0),
(3, 1, 3, 0, 0),
(4, 2, 1, 1, 0),
(5, 2, 2, 0, 0),
(6, 2, 3, 1, 0),
(7, 3, 1, 1, 0),
(8, 3, 2, 0, 0),
(9, 3, 3, 0, 0),
(10, 4, 1, 1, 0),
(11, 4, 2, 0, 0),
(12, 4, 3, 1, 0),
(13, 5, 1, 1, 0),
(14, 5, 2, 1, 0),
(15, 5, 3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rolerequest`
--

DROP TABLE IF EXISTS `rolerequest`;
CREATE TABLE IF NOT EXISTS `rolerequest` (
  `roleRequestId` int(11) NOT NULL AUTO_INCREMENT,
  `usersId` int(11) NOT NULL,
  `requestDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rolesId` int(11) NOT NULL,
  `status` enum('Pending','Approved','Denied') NOT NULL DEFAULT 'Pending',
  `approvedById` int(11) DEFAULT '0',
  `approvedDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `reason` varchar(250) DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`roleRequestId`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rolerequest`
--

INSERT INTO `rolerequest` (`roleRequestId`, `usersId`, `requestDate`, `rolesId`, `status`, `approvedById`, `approvedDate`, `reason`, `isDeleted`) VALUES
(1, 31, '2023-06-24 13:35:06', 2, 'Pending', 0, NULL, NULL, 0),
(2, 32, '2023-06-24 13:39:15', 3, 'Pending', 0, NULL, NULL, 0),
(3, 33, '2023-06-24 13:55:47', 2, 'Approved', 22, '2023-06-24 14:02:54', 'i need to approve', 0),
(4, 30, '2023-06-28 08:43:02', 4, 'Pending', 0, NULL, NULL, 0),
(5, 26, '2023-06-28 08:44:33', 2, 'Pending', 0, NULL, NULL, 0),
(6, 34, '2023-06-28 09:00:50', 3, 'Approved', 22, '2023-06-28 09:43:50', 'approved\r\n', 0),
(7, 34, '2023-06-28 09:52:52', 2, 'Pending', 0, NULL, NULL, 0),
(8, 34, '2023-06-28 10:02:04', 4, 'Pending', 0, NULL, NULL, 0),
(9, 22, '2023-06-28 10:17:14', 4, 'Pending', 0, NULL, NULL, 0),
(10, 22, '2023-06-28 11:34:47', 2, 'Pending', 0, NULL, NULL, 0),
(11, 35, '2023-06-28 11:40:44', 3, 'Approved', 22, '2023-06-28 11:47:11', 'Approved', 0),
(12, 35, '2023-06-28 12:08:20', 2, 'Pending', 0, NULL, NULL, 0),
(13, 36, '2023-06-28 12:17:24', 3, 'Approved', 22, '2023-06-28 12:18:01', 'approved', 0),
(14, 36, '2023-06-28 12:18:47', 2, 'Pending', 0, NULL, NULL, 0),
(15, 36, '2023-06-28 12:30:54', 4, 'Pending', 0, NULL, NULL, 0),
(16, 37, '2023-06-28 12:35:52', 3, 'Approved', 22, '2023-06-28 12:37:06', 'approved', 0),
(17, 37, '2023-06-28 12:38:34', 2, 'Pending', 0, NULL, NULL, 0),
(18, 38, '2023-06-28 12:49:59', 3, 'Approved', 22, '2023-06-28 12:51:41', 'approved', 0),
(19, 38, '2023-06-28 12:54:03', 4, 'Pending', 0, NULL, NULL, 0),
(20, 38, '2023-06-28 13:00:58', 2, 'Pending', 0, NULL, NULL, 0),
(21, 39, '2023-06-28 13:13:08', 3, 'Approved', 22, '2023-06-28 13:15:38', 'approved', 0),
(22, 39, '2023-06-28 13:17:44', 2, 'Pending', 0, NULL, NULL, 0),
(23, 39, '2023-06-28 13:21:38', 4, 'Pending', 0, NULL, NULL, 0),
(24, 37, '2023-06-28 13:24:12', 4, 'Pending', 0, NULL, NULL, 0),
(25, 33, '2023-06-29 05:35:12', 4, 'Pending', 0, NULL, NULL, 0),
(26, 40, '2023-06-29 05:56:17', 2, 'Approved', 22, '2023-06-29 05:57:39', 'approve', 0),
(27, 23, '2023-06-29 06:36:45', 2, 'Pending', 0, NULL, NULL, 0),
(31, 33, '2023-06-30 12:54:17', 3, 'Pending', 0, NULL, NULL, 0),
(32, 40, '2023-06-30 12:59:05', 4, 'Pending', 0, NULL, NULL, 0),
(33, 40, '2023-06-30 13:10:10', 3, 'Pending', 0, NULL, NULL, 0),
(34, 42, '2023-07-01 11:48:12', 2, 'Approved', 22, '2023-07-01 11:49:31', 'Approved\r\n', 0),
(35, 22, '2023-07-07 12:17:02', 3, 'Pending', 0, NULL, NULL, 0),
(36, 42, '2023-07-10 08:28:57', 4, 'Approved', 22, '2023-07-10 08:30:12', 'Approved', 0),
(37, 42, '2023-07-10 14:06:49', 3, 'Pending', 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `rolesId` int(11) NOT NULL AUTO_INCREMENT,
  `rolesName` varchar(30) NOT NULL,
  `rolesDrescription` varchar(200) NOT NULL,
  `addedById` int(11) NOT NULL,
  `addedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Disabled') NOT NULL DEFAULT 'Active',
  `isDeleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rolesId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`rolesId`, `rolesName`, `rolesDrescription`, `addedById`, `addedDate`, `status`, `isDeleted`) VALUES
(1, 'Patient', 'Patients', 1, '2019-06-29 10:19:27', 'Active', 0),
(2, 'Pharmacist', 'Dispenses prescribed medicines', 9, '2023-07-01 07:10:02', 'Active', 0),
(3, 'Physician', 'Prescribes Medecine', 9, '2019-06-29 10:18:48', 'Active', 0),
(4, 'Pharmacy Owner', 'Administers his phramacy', 9, '2019-07-02 07:42:08', 'Active', 0),
(5, 'Admin', 'Administers System', 9, '2019-06-29 10:18:53', 'Active', 0),
(6, 'Test Role', 'I am testing the migration', 22, '2023-06-26 08:49:57', 'Active', 1),
(7, 'Test', 'test', 22, '2023-06-26 07:22:09', 'Active', 1),
(8, 'Farmer', 'jsjdhd', 22, '2023-06-26 07:19:00', 'Active', 1),
(9, 'test', 'test', 22, '2023-06-26 08:52:40', 'Active', 1),
(10, 'Farmer', '', 22, '2023-07-07 08:18:28', 'Active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roletasks`
--

DROP TABLE IF EXISTS `roletasks`;
CREATE TABLE IF NOT EXISTS `roletasks` (
  `roleTasksId` int(11) NOT NULL AUTO_INCREMENT,
  `rolesId` int(11) NOT NULL,
  `tasksId` int(11) NOT NULL,
  `canView` int(11) NOT NULL,
  `canAdd` int(11) NOT NULL,
  `canEdit` int(11) NOT NULL,
  `canDelete` int(11) NOT NULL,
  PRIMARY KEY (`roleTasksId`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roletasks`
--

INSERT INTO `roletasks` (`roleTasksId`, `rolesId`, `tasksId`, `canView`, `canAdd`, `canEdit`, `canDelete`) VALUES
(1, 1, 1, 1, 1, 1, 0),
(2, 1, 2, 1, 1, 1, 0),
(3, 1, 3, 1, 1, 1, 1),
(4, 1, 4, 0, 0, 0, 0),
(5, 1, 5, 0, 0, 0, 0),
(6, 1, 6, 0, 0, 0, 0),
(7, 1, 7, 0, 0, 0, 0),
(8, 1, 8, 0, 0, 0, 0),
(9, 1, 9, 1, 1, 1, 1),
(10, 1, 10, 1, 1, 1, 1),
(11, 1, 11, 0, 0, 0, 0),
(12, 1, 12, 1, 1, 1, 1),
(13, 1, 13, 0, 0, 0, 0),
(14, 1, 14, 0, 0, 0, 0),
(15, 1, 15, 0, 0, 0, 0),
(16, 1, 16, 0, 0, 0, 0),
(17, 1, 17, 0, 0, 0, 0),
(18, 1, 18, 0, 0, 0, 0),
(19, 1, 19, 0, 0, 0, 0),
(20, 1, 20, 0, 0, 0, 0),
(21, 1, 21, 0, 0, 0, 0),
(22, 2, 1, 1, 1, 1, 0),
(23, 2, 2, 0, 0, 0, 0),
(24, 2, 3, 1, 1, 1, 1),
(25, 2, 4, 0, 0, 0, 0),
(26, 2, 5, 0, 0, 0, 0),
(27, 2, 6, 0, 0, 0, 0),
(28, 2, 7, 0, 0, 0, 0),
(29, 2, 8, 1, 1, 1, 0),
(30, 2, 9, 0, 0, 0, 0),
(31, 2, 10, 1, 0, 0, 0),
(32, 2, 11, 1, 1, 1, 0),
(33, 2, 12, 1, 0, 0, 0),
(34, 2, 13, 0, 0, 0, 0),
(35, 2, 14, 0, 0, 0, 0),
(36, 2, 15, 0, 0, 0, 0),
(37, 2, 16, 0, 0, 0, 0),
(38, 2, 17, 0, 0, 0, 0),
(39, 2, 18, 0, 0, 0, 0),
(40, 2, 19, 1, 0, 0, 0),
(41, 2, 20, 1, 0, 0, 0),
(42, 2, 21, 1, 0, 0, 0),
(43, 3, 1, 1, 1, 1, 0),
(44, 3, 2, 0, 0, 0, 0),
(45, 3, 3, 1, 0, 0, 0),
(46, 3, 4, 0, 0, 0, 0),
(47, 3, 5, 1, 1, 1, 1),
(48, 3, 6, 1, 1, 1, 1),
(49, 3, 7, 0, 0, 0, 0),
(50, 3, 8, 0, 0, 0, 0),
(51, 3, 9, 1, 0, 0, 0),
(52, 3, 10, 1, 0, 0, 0),
(53, 3, 11, 0, 0, 0, 0),
(54, 3, 12, 1, 0, 0, 0),
(55, 3, 13, 0, 0, 0, 0),
(56, 3, 14, 0, 0, 0, 0),
(57, 3, 15, 0, 0, 0, 0),
(58, 3, 16, 0, 0, 0, 0),
(59, 3, 17, 0, 0, 0, 0),
(60, 3, 18, 0, 0, 0, 0),
(61, 3, 19, 0, 0, 0, 0),
(62, 3, 20, 0, 0, 0, 0),
(63, 3, 21, 0, 0, 0, 0),
(64, 4, 1, 1, 1, 1, 0),
(65, 4, 2, 0, 0, 0, 0),
(66, 4, 3, 0, 0, 0, 0),
(67, 4, 4, 0, 0, 0, 0),
(68, 4, 5, 0, 0, 0, 0),
(69, 4, 6, 0, 0, 0, 0),
(70, 4, 7, 0, 0, 0, 0),
(71, 4, 8, 1, 1, 0, 0),
(72, 4, 9, 0, 0, 0, 0),
(73, 4, 10, 0, 0, 0, 0),
(74, 4, 11, 1, 1, 1, 1),
(75, 4, 12, 0, 0, 0, 0),
(76, 4, 13, 0, 0, 0, 0),
(77, 4, 14, 0, 0, 0, 0),
(78, 4, 15, 0, 0, 0, 0),
(79, 4, 16, 0, 0, 0, 0),
(80, 4, 17, 0, 0, 0, 0),
(81, 4, 18, 0, 0, 0, 0),
(82, 4, 19, 1, 0, 0, 0),
(83, 4, 20, 1, 0, 0, 0),
(84, 4, 21, 1, 0, 0, 0),
(85, 5, 1, 1, 1, 1, 1),
(86, 5, 2, 1, 1, 1, 1),
(87, 5, 3, 1, 0, 0, 0),
(88, 5, 4, 1, 1, 1, 1),
(89, 5, 5, 1, 1, 1, 1),
(90, 5, 6, 1, 1, 1, 1),
(91, 5, 7, 1, 1, 1, 1),
(92, 5, 8, 1, 1, 1, 1),
(93, 5, 9, 1, 0, 0, 0),
(94, 5, 10, 1, 0, 0, 0),
(95, 5, 11, 1, 1, 1, 1),
(96, 5, 12, 1, 0, 0, 0),
(97, 5, 13, 1, 1, 1, 1),
(98, 5, 14, 1, 1, 1, 1),
(99, 5, 15, 1, 1, 1, 1),
(100, 5, 16, 1, 1, 1, 1),
(101, 5, 17, 1, 1, 1, 1),
(102, 5, 18, 1, 1, 1, 1),
(103, 5, 19, 1, 1, 1, 1),
(104, 5, 20, 1, 1, 1, 1),
(105, 5, 21, 1, 1, 1, 1),
(106, 5, 22, 1, 1, 1, 1),
(107, 1, 22, 0, 0, 0, 0),
(108, 2, 22, 0, 0, 0, 0),
(109, 3, 22, 0, 0, 0, 0),
(110, 4, 22, 0, 0, 0, 0),
(111, 3, 23, 0, 0, 0, 0),
(112, 1, 23, 0, 0, 0, 0),
(113, 2, 23, 0, 0, 0, 0),
(114, 4, 23, 0, 0, 0, 0),
(115, 5, 23, 1, 1, 1, 1),
(116, 1, 24, 0, 0, 0, 0),
(117, 1, 25, 1, 0, 0, 0),
(118, 2, 24, 0, 0, 0, 0),
(119, 2, 25, 0, 0, 0, 0),
(120, 3, 24, 0, 0, 0, 0),
(121, 3, 25, 1, 0, 0, 0),
(122, 4, 24, 1, 1, 1, 1),
(123, 4, 25, 1, 1, 1, 1),
(124, 5, 24, 1, 1, 1, 1),
(125, 5, 25, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `solddrugs`
--

DROP TABLE IF EXISTS `solddrugs`;
CREATE TABLE IF NOT EXISTS `solddrugs` (
  `soldDrugsId` int(11) NOT NULL AUTO_INCREMENT,
  `prescribedDrugsId` int(11) NOT NULL,
  `pharmacyId` int(11) NOT NULL,
  `soldDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `soldQty` double NOT NULL,
  PRIMARY KEY (`soldDrugsId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

DROP TABLE IF EXISTS `specialization`;
CREATE TABLE IF NOT EXISTS `specialization` (
  `specializationId` int(11) NOT NULL AUTO_INCREMENT,
  `specializationName` varchar(100) NOT NULL,
  PRIMARY KEY (`specializationId`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`specializationId`, `specializationName`) VALUES
(1, 'Allergist'),
(2, 'Anaesthesiologist'),
(3, 'Andrologist'),
(4, 'Cardiologist'),
(5, 'Cardiac Electrophysiologist'),
(6, 'Dermatologist'),
(7, 'Emergency Room (ER) Doctors'),
(8, 'Endocrinologist'),
(9, 'Epidemiologist'),
(10, 'Family Medicine Physician'),
(11, 'Gastroenterologist'),
(12, 'Geriatrician'),
(13, 'Hyperbaric Physician'),
(14, 'Hematologist'),
(15, 'Hepatologist'),
(16, 'Immunologist'),
(17, 'Infectious Disease Specialist'),
(18, 'Intensivist'),
(19, 'Internal Medicine Specialist'),
(20, 'Maxillofacial Surgeon / Oral Surgeon'),
(21, 'Medical Examiner'),
(22, 'Medical Geneticist'),
(23, 'Neonatologist'),
(24, 'Nephrologist'),
(25, 'Neurologist'),
(26, 'Neurosurgeon'),
(27, 'Nuclear Medicine Specialist'),
(28, 'Obstetrician/Gynecologist (OB/GYN)'),
(29, 'Occupational Medicine Specialist'),
(30, 'Oncologist'),
(31, 'Ophthalmologist'),
(32, 'Orthopedic Surgeon / Orthopedist'),
(33, 'Otolaryngologist (also ENT Specialist)'),
(34, 'Parasitologist'),
(35, 'Pathologist'),
(36, 'Perinatologist'),
(37, 'Periodontist'),
(38, 'Pediatrician'),
(39, 'Physiatrist'),
(40, 'Plastic Surgeon'),
(41, 'Psychiatrist'),
(42, 'Pulmonologist'),
(43, 'Radiologist'),
(44, 'Rheumatologist'),
(45, 'Sleep Doctor / Sleep Disorders Specialist'),
(46, 'Spinal Cord Injury Specialist'),
(47, 'Sports Medicine Specialist'),
(48, 'Surgeon'),
(49, 'Thoracic Surgeon'),
(50, 'Urologist'),
(51, 'Vascular Surgeon'),
(52, 'Veterinarian'),
(53, 'Acupuncturist'),
(54, 'Audiologist'),
(55, 'Ayurvedic Practioner'),
(56, 'Chiropractor'),
(57, 'Diagnostician'),
(58, 'Homeopathic Doctor'),
(59, 'Microbiologist'),
(60, 'Naturopathic Doctor'),
(61, 'Palliative care specialist'),
(62, 'Pharmacist'),
(63, 'Physiotherapist'),
(64, 'Podiatrist / Chiropodist'),
(65, 'Registered Massage Therapist');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `stateId` int(11) NOT NULL AUTO_INCREMENT,
  `countryId` int(11) NOT NULL,
  `stateName` varchar(100) NOT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`stateId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`stateId`, `countryId`, `stateName`, `isDeleted`) VALUES
(1, 1, 'Tigray', 0),
(2, 1, 'Amhara', 0),
(3, 1, 'Oromia', 0),
(4, 1, 'Somali', 0),
(5, 1, 'Afar', 0),
(6, 1, 'Gambela', 0),
(7, 1, 'Harari', 0),
(8, 1, 'Benishangul Gumz', 0),
(9, 1, 'Sidama', 0),
(10, 1, 'SNNP', 0),
(11, 1, 'South West Ethiopia', 0),
(12, 1, 'Addis Abeba', 0),
(13, 1, 'Dire Dawa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `tasksId` int(11) NOT NULL AUTO_INCREMENT,
  `menusId` int(11) NOT NULL,
  `tasksVarName` varchar(50) NOT NULL,
  `tasksName` varchar(50) NOT NULL,
  `tasksUrl` varchar(500) NOT NULL,
  `tasksOrder` int(11) NOT NULL,
  `canView` varchar(200) NOT NULL,
  `canAdd` varchar(200) NOT NULL,
  `canEdit` varchar(200) NOT NULL,
  `canDelete` varchar(200) NOT NULL,
  PRIMARY KEY (`tasksId`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`tasksId`, `menusId`, `tasksVarName`, `tasksName`, `tasksUrl`, `tasksOrder`, `canView`, `canAdd`, `canEdit`, `canDelete`) VALUES
(1, 1, 'analytics', 'Analytics', '?name=hub/analytics/analytics&var=analytics', 1, '1,2,3,4,5,6,7,8,10', '1,2,3,4,5,6,8,10', '1,2,3,4,5,6,8', '5,6'),
(2, 1, 'myPrescriptions', 'My Prescriptions', '?name=hub/prescriptions/my-prescriptions/myprescriptions&var=myPrescriptions', 2, '1,5,10', '1,5,7,8,10', '1,5,7,8,10', '5,7'),
(5, 1, 'myPatients', 'My Patients', '?name=hub/patients/my-patients/mypatients&var=myPatients', 5, '3,5,9', '3,5,9', '3,5,9', '5'),
(6, 1, 'prescriptions', 'Prescriptions', '?name=hub/prescriptions/prescribe/prescriptions&var=prescriptions', 6, '5,3,9', '5,3,9', '5,3,9', '5'),
(8, 1, 'prescriptionHub', 'Prescription Hub', '?name=hub/prescriptions/prescription-hub/prescriptionhub&var=prescriptionHub', 8, '5,2,4', '5,2,4', '5,2', '5'),
(11, 1, 'myPharmacy', 'My Pharmacy', '?name=hub/pharmacy/my-pharmacy/mypharmacy&var=myPharmacy', 11, '5,4,2,8', '5,4,2', '5,4,2', '5,4,2'),
(13, 2, 'addresses', 'addresses', '?name=configurations/addresses/addresses&var=addresses', 1, '5', '5', '', ''),
(14, 2, 'educationLevels', 'Education Levels', '?name=configurations/educations/educationlevels&var=educationLevels', 2, '5,9', '5,9', '5', '5'),
(15, 2, 'roles', 'Roles', '?name=configurations/roles/roles&var=roles', 3, '5,9', '5,9', '5,9', '5'),
(16, 2, 'users', 'Users', '?name=configurations/users/users&var=users', 4, '5,9', '5,9', '5,9', '5'),
(17, 2, 'drugs', 'Drugs', '?name=configurations/drugs/drugs&var=drugs', 6, '5,9', '5,9', '5,9', '5'),
(18, 2, 'pharmacy', 'Pharmacy', '?name=configurations/pharmacy/pharmacy&var=pharmacy', 7, '5', '5', '5', '5'),
(19, 3, 'total reports', 'Reports', '?name=hub/analytics/analytics&var=analytics', 1, '5', '5', '5', '5'),
(22, 2, 'roleRequests', 'Role Requests', '?name=configurations/role-requests/rolerequests&var=roleRequests', 5, '5', '5', '5', '5'),
(23, 2, 'profile', 'Profile', '?name=configurations/users/profile&var=profile', 8, '5', '5', '5', '5'),
(24, 1, 'findPhysician', 'Find Physician', '?name=hub/physician/find-physician/findphysicians&var=findPhysician', 10, '5,1', '5,1', '5,1', '5'),
(25, 1, 'findPharmacy', 'Find Pharmacy', '?name=hub/pharmacy/find-pharmacy/findpharmacy&var=findPharmacy', 9, '5,1,2,3,4', '5,4', '5,4', '5'),
(26, 1, 'uploadedPrescriptions', 'Uploaded Prescriptions', '?name=hub/prescriptions/uploaded-prescriptions/uploadedprescriptions&var=uploadedPrescriptions', 11, '5', '5', '5', '5');

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

DROP TABLE IF EXISTS `title`;
CREATE TABLE IF NOT EXISTS `title` (
  `titleId` int(11) NOT NULL AUTO_INCREMENT,
  `titleName` varchar(20) NOT NULL,
  PRIMARY KEY (`titleId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`titleId`, `titleName`) VALUES
(1, 'Mr.'),
(2, 'Ms.'),
(3, 'Dr'),
(4, 'Prof');

-- --------------------------------------------------------

--
-- Table structure for table `uploadedprescriptions`
--

DROP TABLE IF EXISTS `uploadedprescriptions`;
CREATE TABLE IF NOT EXISTS `uploadedprescriptions` (
  `uploadedPrescriptionsId` int(11) NOT NULL AUTO_INCREMENT,
  `usersId` int(11) NOT NULL,
  `imageName` varchar(250) NOT NULL,
  `comment` varchar(2000) DEFAULT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `uploadedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Pending','Processed','Not in Range','Cancelled') NOT NULL,
  `dispensedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uploadedPrescriptionsId`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploadedprescriptions`
--

INSERT INTO `uploadedprescriptions` (`uploadedPrescriptionsId`, `usersId`, `imageName`, `comment`, `latitude`, `longitude`, `uploadedDate`, `status`, `dispensedDate`) VALUES
(1, 22, 'medco_sc.PNG', 'Need this!', 13.544598206209912, 39.57561034919945, '2019-10-21 13:10:04', 'Pending', '2019-11-19 08:28:02'),
(13, 24, 'imageName', 'I want this prescription', 13.529375942847683, 39.51757211000461, '2019-10-21 13:36:43', 'Pending', '2019-11-19 08:28:02'),
(14, 22, 'imageName', NULL, 13.48184738968174, 39.48257436259814, '2019-11-21 06:02:47', 'Pending', '2019-11-21 06:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `uploadedprescriptionstatus`
--

DROP TABLE IF EXISTS `uploadedprescriptionstatus`;
CREATE TABLE IF NOT EXISTS `uploadedprescriptionstatus` (
  `uploadedPrescriptionStatusId` int(11) NOT NULL AUTO_INCREMENT,
  `uploadedPrescriptionsId` int(11) NOT NULL,
  `pharmacyId` int(11) NOT NULL,
  `pharmacistId` int(11) NOT NULL,
  `distanceFromRequester` double NOT NULL,
  `status` enum('Accepted','Released','Dispensed','Cancelled') NOT NULL,
  `actionDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`uploadedPrescriptionStatusId`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploadedprescriptionstatus`
--

INSERT INTO `uploadedprescriptionstatus` (`uploadedPrescriptionStatusId`, `uploadedPrescriptionsId`, `pharmacyId`, `pharmacistId`, `distanceFromRequester`, `status`, `actionDate`) VALUES
(62, 1, 12, 26, 11.58, 'Dispensed', '2019-11-23 09:05:22'),
(63, 13, 12, 26, 5.2, 'Accepted', '2019-11-23 09:09:01'),
(64, 1, 11, 26, 10.49, 'Accepted', '2019-11-23 14:01:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `usersId` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(500) DEFAULT NULL,
  `fatherName` varchar(500) DEFAULT NULL,
  `grandFatherName` varchar(500) DEFAULT NULL,
  `titleId` int(11) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `mobilePhone` varchar(500) NOT NULL,
  `officePhone` varchar(500) DEFAULT NULL,
  `userName` varchar(500) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `lastLoginTime` datetime DEFAULT NULL,
  `lastLoginLatitude` double NOT NULL,
  `lastLoginLongitude` double NOT NULL,
  `status` enum('limitedAccess','active','disabled') DEFAULT 'active',
  `profilePicture` varchar(100) DEFAULT 'defaultMale.jpg',
  `countryId` int(11) DEFAULT '0',
  `stateId` int(11) DEFAULT '0',
  `zoneId` int(11) DEFAULT '0',
  `woredaId` int(11) DEFAULT '0',
  `kebelle` varchar(100) DEFAULT NULL,
  `licenceId` int(11) DEFAULT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0',
  `registrationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `emailVerification` int(11) DEFAULT '0',
  `phoneVerification` int(11) DEFAULT '0',
  `registeredById` int(11) DEFAULT '0',
  `usersDefaultRolesId` int(11) DEFAULT '1',
  PRIMARY KEY (`usersId`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `firstName`, `fatherName`, `grandFatherName`, `titleId`, `gender`, `dateOfBirth`, `email`, `mobilePhone`, `officePhone`, `userName`, `password`, `lastLoginTime`, `lastLoginLatitude`, `lastLoginLongitude`, `status`, `profilePicture`, `countryId`, `stateId`, `zoneId`, `woredaId`, `kebelle`, `licenceId`, `isDeleted`, `registrationDate`, `emailVerification`, `phoneVerification`, `registeredById`, `usersDefaultRolesId`) VALUES
(22, 'Halefom', 'Desta', 'Fitsum', 1, 'Male', '2017-04-13', 'Halefomdesta@gmail.com', '0933790767', NULL, 'Admin', 'f6b6c851d8336af0eacaf63c9f7b93acebbdaf7d8d1d4e7c3378b99f36f9a83997a21553edade38f7d67498be467fca4d5b6feb8540341c4081c95953ec08700', '2023-07-11 12:34:48', 13.489322973759279, 39.47001129237765, 'active', 'Admin_vj7jq.jpg', 1, 1, 7, 1, '18', 1, 0, '2019-07-01 15:25:22', 1, 0, 0, 5),
(23, 'Semere', 'Tsadik', 'Lema', 1, 'Male', '2019-07-18', 'Semere@gmail.com', '0901525350', NULL, 'Physician', '071655ed09b98eea3d20e94b93db57f172344944c93e4622b506f66b81d8e906d1bf99f9bba85093372aeb031a15ee3b249013f8decd34bfc35fb2a2f32d9438', '2023-07-10 08:23:09', 13.489456352377218, 39.469995145057126, 'active', 'defaultMale.jpg', 0, 0, 0, 0, NULL, 1, 0, '2019-07-03 06:47:17', 1, 0, 0, 3),
(24, 'Rezene', 'Hagos', 'T', 1, 'Male', '2019-07-18', 'Rezenehagos@gmail.com', '0914194450', NULL, 'Patient', '071655ed09b98eea3d20e94b93db57f172344944c93e4622b506f66b81d8e906d1bf99f9bba85093372aeb031a15ee3b249013f8decd34bfc35fb2a2f32d9438', '2023-07-06 04:41:51', 0, 0, 'active', 'defaultMale.jpg', 0, 0, 0, 0, NULL, 1, 0, '2019-07-03 06:53:17', 1, 0, 0, 1),
(25, 'Dawit', 'Fsaha', 'Welegebriel', 1, 'Male', '2019-07-10', 'Davefsaha@gmail.com', '0932342586', NULL, 'Pharmacist', '071655ed09b98eea3d20e94b93db57f172344944c93e4622b506f66b81d8e906d1bf99f9bba85093372aeb031a15ee3b249013f8decd34bfc35fb2a2f32d9438', '2023-06-23 06:25:29', 0, 0, 'active', 'defaultMale.jpg', 0, 0, 0, 0, NULL, 1, 0, '2019-07-03 06:54:31', 1, 0, 0, 2),
(26, 'Samuel', 'Amare', 'Lema', 1, 'Male', '2019-07-17', 'Sami@gmail.com', '0914556677', NULL, 'Powner', '071655ed09b98eea3d20e94b93db57f172344944c93e4622b506f66b81d8e906d1bf99f9bba85093372aeb031a15ee3b249013f8decd34bfc35fb2a2f32d9438', '2023-07-11 11:56:18', 13.489473655578099, 39.46995592708437, 'active', 'Powner_40q64.jpg', 1, 1, 1, 6, '18', 1, 0, '2019-07-03 06:57:14', 1, 0, 0, 4),
(30, 'Bele', 'Hagos', 'Gebreslassie', 1, 'Male', '1998-10-10', 'Bele@gmail.com', '0914194450', NULL, 'Bele', '071655ed09b98eea3d20e94b93db57f172344944c93e4622b506f66b81d8e906d1bf99f9bba85093372aeb031a15ee3b249013f8decd34bfc35fb2a2f32d9438', '2023-07-05 06:18:02', 0, 0, 'active', 'defaultMale.jpg', 0, 0, 0, 0, NULL, 1, 0, '2019-07-31 12:34:07', 1, 0, 0, 1),
(31, 'Kehase', 'Hagos', 'gebreslassie', 1, 'Male', '2005-06-23', 'Kehase@gmail.com', '0912345678', NULL, 'Kehase', '071655ed09b98eea3d20e94b93db57f172344944c93e4622b506f66b81d8e906d1bf99f9bba85093372aeb031a15ee3b249013f8decd34bfc35fb2a2f32d9438', NULL, 0, 0, 'limitedAccess', 'defaultMale.jpg', 0, 0, 0, 0, NULL, 1, 0, '2023-06-24 13:35:06', 0, 0, 0, 2),
(37, 'Haben', 'Kiflewahd', 'Teklay', 1, 'Male', '2005-06-18', 'Hkiflewahd@gmail.com', '0910388773', NULL, 'Habu21', '85ed05ed99641745a1f6c4e0b7056ae054a81e961b2f7cf4ae31bfe74d090b7056e1ba590dd1b27d727db93bf2f4cf15984710bbe0a0a93f274865f67919d0a3', '2023-06-29 05:17:48', 0, 0, 'active', 'defaultMale.jpg', 0, 0, 0, 0, NULL, 1, 0, '2023-06-28 12:35:52', 1, 0, 0, 3),
(38, 'Solomon', 'Gebremikael', 'Grmay', 1, 'Male', '2005-06-18', 'Habu.kifle1224@gmail.com', '0912828192', NULL, 'Sele12', '500c270cf75a69751c6f7dec6ea11fdcb5db9865487ffcdbd59195b9086675cfc173962ba1e878bc7d5595a13632e40528e03cae64a781db87e1b163a03ec34e', '2023-06-30 03:02:08', 0, 0, 'active', 'defaultMale.jpg', 0, 0, 0, 0, NULL, 1, 0, '2023-06-28 12:49:59', 1, 0, 0, 3),
(40, 'Tewelde', 'Bisrat', 'Teklay', 1, 'Male', '2005-06-16', 'Tewe@gmail.com', '0918291929', NULL, 'Tewe12', 'f654887ac1812a0aae0f6359d7b7768f9aa55ad8b0ccb774d5602237aeebe6241775a90500ded69c4a7969fae9e4571daf7763a0daff65a4b6fba9271b156d76', '2023-07-10 07:09:24', 13.489412996086772, 39.469926762739966, 'active', 'defaultMale.jpg', 0, 0, 0, 0, NULL, 1, 0, '2023-06-29 05:56:17', 1, 0, 0, 2),
(41, 'Abraham', 'Berhe', 'Teklay', 1, 'Male', '2017-02-01', NULL, '0942345465', NULL, NULL, NULL, NULL, 0, 0, 'active', 'defaultMale.jpg', 0, 0, 0, 0, NULL, NULL, 0, '2023-07-01 07:57:10', 0, 0, 23, 1),
(42, 'Danayt', 'Geta', 'Belay', 2, 'Male', '2005-06-28', 'Dana@gmail.com', '0998899999', NULL, 'Dana12', '619da00b7d29062a5621ac9eae458febcecfc88a9abea974f2a9b0d0dc86633986adb9d2faecf4759eca5c7b8bbfda07dde93bcc5af25d9d3a6be699a3f7a3dd', '2023-07-11 09:44:19', 13.489339113262654, 39.46990945995119, 'active', 'Dana12_vr5lh.jpg', 0, 0, 0, 0, NULL, 1, 0, '2023-07-01 11:48:12', 1, 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `usersinfo`
--

DROP TABLE IF EXISTS `usersinfo`;
CREATE TABLE IF NOT EXISTS `usersinfo` (
  `usersInfoId` int(11) NOT NULL AUTO_INCREMENT,
  `usersId` int(11) NOT NULL,
  `employmentType` varchar(50) NOT NULL,
  `companyDescription` varchar(200) NOT NULL,
  PRIMARY KEY (`usersInfoId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usersrole`
--

DROP TABLE IF EXISTS `usersrole`;
CREATE TABLE IF NOT EXISTS `usersrole` (
  `usersRoleId` int(11) NOT NULL AUTO_INCREMENT,
  `usersId` int(11) NOT NULL,
  `rolesId` int(11) NOT NULL,
  `isDefault` int(11) NOT NULL,
  `addedById` int(11) NOT NULL,
  `addedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`usersRoleId`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersrole`
--

INSERT INTO `usersrole` (`usersRoleId`, `usersId`, `rolesId`, `isDefault`, `addedById`, `addedDate`, `active`, `isDeleted`) VALUES
(4, 22, 5, 1, 22, '2019-09-05 11:45:48', 1, 0),
(5, 23, 3, 1, 23, '2019-09-05 10:32:23', 1, 0),
(6, 24, 1, 1, 24, '2019-09-05 11:45:46', 1, 0),
(7, 25, 2, 1, 25, '2019-09-05 11:45:57', 1, 0),
(8, 26, 4, 1, 26, '2019-09-05 11:45:52', 1, 0),
(11, 26, 2, 0, 22, '2019-09-05 10:25:45', 1, 0),
(12, 30, 1, 0, 30, '2019-07-31 12:36:42', 1, 0),
(13, 30, 2, 1, 22, '2019-09-05 11:46:04', 1, 0),
(14, 23, 4, 0, 22, '2019-09-05 10:32:14', 1, 0),
(15, 103, 1, 1, 103, '2019-11-25 17:16:59', 1, 0),
(20, 33, 2, 1, 22, '2023-06-24 14:02:23', 1, 0),
(25, 34, 3, 1, 22, '2023-06-28 09:43:50', 1, 0),
(26, 35, 3, 1, 22, '2023-06-28 11:47:11', 1, 0),
(27, 36, 3, 1, 22, '2023-06-28 12:18:01', 1, 0),
(28, 37, 3, 1, 22, '2023-06-28 12:37:06', 1, 0),
(29, 38, 3, 1, 22, '2023-06-28 12:51:41', 1, 0),
(30, 39, 3, 1, 22, '2023-06-28 13:15:38', 1, 0),
(31, 40, 2, 1, 22, '2023-06-29 05:57:39', 1, 0),
(32, 42, 2, 0, 22, '2023-07-10 08:30:12', 1, 0),
(33, 42, 4, 1, 22, '2023-07-10 08:30:12', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `woreda`
--

DROP TABLE IF EXISTS `woreda`;
CREATE TABLE IF NOT EXISTS `woreda` (
  `woredaId` int(11) NOT NULL AUTO_INCREMENT,
  `zoneId` int(11) NOT NULL,
  `woredaName` varchar(100) NOT NULL,
  PRIMARY KEY (`woredaId`)
) ENGINE=InnoDB AUTO_INCREMENT=2845 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `woreda`
--

INSERT INTO `woreda` (`woredaId`, `zoneId`, `woredaName`) VALUES
(1, 1, 'Tahtay Adiyabo'),
(2, 1, 'Laelay Adiabo'),
(3, 1, 'Zana'),
(4, 1, 'Tahtay Koraro'),
(5, 1, 'Asgede'),
(6, 1, 'Tselemti'),
(7, 1, 'Sheraro town'),
(8, 1, 'Indasilassie town'),
(9, 1, 'Selekleka'),
(10, 1, 'Seyemti Adyabo'),
(11, 1, 'Adi Daero'),
(12, 1, 'Adi Hageray'),
(13, 1, 'Tsimbla'),
(14, 1, 'Endabaguna town'),
(15, 1, 'Dima (TG)'),
(16, 1, 'May Tsebri town'),
(17, 2, 'Chila'),
(18, 2, 'Aheferom'),
(19, 2, 'Edaga arbi'),
(20, 2, 'Adwa'),
(21, 2, 'Laelay Maychew'),
(22, 2, 'Tahtay Mayechew'),
(23, 2, 'Adet'),
(24, 2, 'Kola Temben'),
(25, 2, 'Naeder'),
(26, 2, 'Abergele (TG)'),
(27, 2, 'Abi Adi town'),
(28, 2, 'Adwa town'),
(29, 2, 'Axum town'),
(30, 2, 'Rama'),
(31, 2, 'Ahsea'),
(32, 2, 'Egela'),
(33, 2, 'Hahayle'),
(34, 2, 'Endafelasi'),
(35, 2, 'Emba Sieneti'),
(36, 2, 'Enticho town'),
(37, 2, 'Keyhe tekli'),
(38, 2, 'Tanqua Melashe'),
(39, 3, 'Gulo Mekeda'),
(40, 3, 'Erob'),
(41, 3, 'Saesie'),
(42, 3, 'Ganta Afeshum'),
(43, 3, 'Hawzen'),
(44, 3, 'Kelete Awelallo'),
(45, 3, 'Atsbi'),
(46, 3, 'Adigrat town'),
(47, 3, 'Wukro town'),
(48, 3, 'Bizet'),
(49, 3, 'Edaga Hamus town'),
(50, 3, 'Hawzen town'),
(51, 3, 'Freweyni town'),
(52, 3, 'Tsaeda Emba'),
(53, 3, 'Atsbi town'),
(54, 3, 'Agulae'),
(55, 3, 'Geraleta'),
(56, 3, 'Zala Anbesa town'),
(57, 4, 'Selewa'),
(58, 4, 'Bora (TG)'),
(59, 4, 'Neqsege'),
(60, 4, 'Emba Alaje'),
(61, 4, 'Endamehoni'),
(62, 4, 'Raya Azebo'),
(63, 4, 'Raya Alamata'),
(64, 4, 'Ofla'),
(65, 4, 'Maichew town'),
(66, 4, 'Korem town'),
(67, 4, 'Alamata town'),
(68, 4, 'Mekhoni town'),
(69, 4, 'Zata'),
(70, 4, 'Chercher'),
(71, 5, 'Kafta Humera'),
(72, 5, 'Welkait'),
(73, 5, 'Tsegede (TG)'),
(74, 5, 'Setit Humera'),
(75, 5, 'May Kadra'),
(76, 5, 'Dansha town'),
(77, 5, 'Awra (TG)'),
(78, 5, 'Korarit'),
(79, 5, 'May Gaba'),
(80, 6, 'Saharti'),
(81, 6, 'Enderta'),
(82, 6, 'Hintalo'),
(83, 6, 'Degua Temben'),
(84, 6, 'Hagere Selam town'),
(85, 6, 'Samre'),
(86, 6, 'Adigudom'),
(87, 6, 'Wajirat'),
(88, 7, 'Mekelle'),
(89, 8, 'Dubti'),
(90, 8, 'Elidar'),
(91, 8, 'Asayita'),
(92, 8, 'Afambo'),
(93, 8, 'Mile'),
(94, 8, 'Chifra'),
(95, 8, 'Dubti town'),
(96, 8, 'Kori'),
(97, 8, 'Adar'),
(98, 8, 'Gerani'),
(99, 8, 'Asayita town'),
(100, 8, 'Samera Logiya town'),
(101, 9, 'Erebti'),
(102, 9, 'Kunneba'),
(103, 9, 'Abaala'),
(104, 9, 'Megale'),
(105, 9, 'Berahile'),
(106, 9, 'Dalol'),
(107, 9, 'Afdera'),
(108, 9, 'Bidu'),
(109, 9, 'Abaala town'),
(110, 10, 'Amibara'),
(111, 10, 'Awash'),
(112, 10, 'Gewane'),
(113, 10, 'Dulecha'),
(114, 10, 'Gelalu'),
(115, 10, 'Arguba'),
(116, 10, 'Hanruka'),
(117, 10, 'Awash town'),
(118, 11, 'Awra (AF)'),
(119, 11, 'Euwa'),
(120, 11, 'Teru'),
(121, 11, 'Yalo'),
(122, 11, 'Gulina'),
(123, 12, 'Telalek'),
(124, 12, 'Samurobi'),
(125, 12, 'Dawe'),
(126, 12, 'Dalefage'),
(127, 12, 'Hadelela'),
(128, 13, 'Addi Arekay'),
(129, 13, 'Beyeda'),
(130, 13, 'Janamora'),
(131, 13, 'Debark'),
(132, 13, 'Dabat'),
(133, 13, 'Dabat town'),
(134, 13, 'Telemt'),
(135, 13, 'Debark town'),
(136, 14, 'Ebenat'),
(137, 14, 'Libokemekem'),
(138, 14, 'Fogera'),
(139, 14, 'Farta'),
(140, 14, 'Lay Gayint'),
(141, 14, 'Tach Gayint'),
(142, 14, 'Semada'),
(143, 14, 'East Esite'),
(144, 14, 'Dera (AM)'),
(145, 14, 'Debre Tabor town'),
(146, 14, 'Andabet/ West Esite'),
(147, 14, 'Guna Begemider'),
(148, 14, 'Mena Meketewa'),
(149, 14, 'Sede Muja'),
(150, 14, 'Nefas Mewicha town'),
(151, 14, 'Wegeda town'),
(152, 14, 'Ebenat town'),
(153, 14, 'Hamusit town'),
(154, 14, 'Woreta town'),
(155, 14, 'Mekan Eyesuse'),
(156, 14, 'Adiss Zemen town'),
(157, 15, 'Bugna'),
(158, 15, 'Raya Kobo'),
(159, 15, 'Gidan'),
(160, 15, 'Meket'),
(161, 15, 'Wadla'),
(162, 15, 'Hara town'),
(163, 15, 'Guba Lafto'),
(164, 15, 'Habru'),
(165, 15, 'Woldiya town'),
(166, 15, 'Lasta'),
(167, 15, 'Dawunt'),
(168, 15, 'Gazo'),
(169, 15, 'Angot'),
(170, 15, 'Filakit town'),
(171, 15, 'Gashena town'),
(172, 15, 'Mersa town'),
(173, 15, 'Lalibela town'),
(174, 15, 'Kobo town'),
(175, 16, 'Argoba'),
(176, 16, 'Tenta'),
(177, 16, 'Kutaber'),
(178, 16, 'Ambasel'),
(179, 16, 'Thehulederie'),
(180, 16, 'Delanta'),
(181, 16, 'Kalu'),
(182, 16, 'Albuko'),
(183, 16, 'Dessie Zuria'),
(184, 16, 'Legambo'),
(185, 16, 'Sayint'),
(186, 16, 'Borena /Debresina'),
(187, 16, 'Kelela'),
(188, 16, 'Jama'),
(189, 16, 'Were Ilu'),
(190, 16, 'Wegde'),
(191, 16, 'Kombolcha town'),
(192, 16, 'Dessie town'),
(193, 16, 'Mehal Sayint'),
(194, 16, 'Legehida'),
(195, 16, 'Mekdela'),
(196, 16, 'Worebabu'),
(197, 16, 'Wereilu town'),
(198, 16, 'Wegel tena town'),
(199, 16, 'Degolo town'),
(200, 16, 'Kelala town'),
(201, 16, 'Akeseta town'),
(202, 16, 'Tulu Awlia'),
(203, 16, 'Harbu town'),
(204, 16, 'Mekane Selame'),
(205, 16, 'Hike town'),
(206, 17, 'Mida Woremo'),
(207, 17, 'Merhabete'),
(208, 17, 'Ensaro'),
(209, 17, 'Moretna Jiru'),
(210, 17, 'Menze Gera Midir'),
(211, 17, 'Gishe Rabel'),
(212, 17, 'Antsokiya'),
(213, 17, 'Eferatana Gidem'),
(214, 17, 'Menze Mama Midir'),
(215, 17, 'Tarema Ber'),
(216, 17, 'Mojan Wedera'),
(217, 17, 'Kewet'),
(218, 17, 'Angolelana Tera'),
(219, 17, 'Assagirt'),
(220, 17, 'Ankober'),
(221, 17, 'Hagere Mariam'),
(222, 17, 'Berehet'),
(223, 17, 'Minjar Shenkora'),
(224, 17, 'Basona Worena'),
(225, 17, 'Debre Berhan town'),
(226, 17, 'Menze Keya Gabriel'),
(227, 17, 'Menze Lalo Midir'),
(228, 17, 'Siya Debirna Wayu'),
(229, 17, 'Tulefa town'),
(230, 17, 'Arerti town'),
(231, 17, 'Molale town'),
(232, 17, 'Debre Sina town'),
(233, 17, 'Shoa Robit'),
(234, 17, 'Mehale Meda town'),
(235, 17, 'Ataye town'),
(236, 17, 'Aleme Ketma town'),
(237, 18, 'Bibugn'),
(238, 18, 'Hulet Ej Enese'),
(239, 18, 'Goncha Siso Enebse'),
(240, 18, 'Enebse Sarmder'),
(241, 18, 'Enarj Enawga'),
(242, 18, 'Enemay'),
(243, 18, 'Debay Telatgen'),
(244, 18, 'Debre Elias'),
(245, 18, 'Michakel'),
(246, 18, 'Guzamn'),
(247, 18, 'Baso Liben'),
(248, 18, 'Awabel'),
(249, 18, 'Dejen'),
(250, 18, 'Shebel Bernta'),
(251, 18, 'Debre Markos town'),
(252, 18, 'Senan'),
(253, 18, 'Aneded'),
(254, 18, 'Amanuel town'),
(255, 18, 'Sedae'),
(256, 18, 'Gundwoin town'),
(257, 18, 'Debrework town'),
(258, 18, 'Lumame town'),
(259, 18, 'Merto Lemariyam town'),
(260, 18, 'Mota Town'),
(261, 18, 'Dejen town'),
(262, 18, 'Bechena Town'),
(263, 19, 'Semen Achefer'),
(264, 19, 'Bahirdar Zuria'),
(265, 19, 'Yilmana Densa'),
(266, 19, 'Mecha'),
(267, 19, 'Sekela'),
(268, 19, 'Quarit'),
(269, 19, 'Dega Damot'),
(270, 19, 'Dembecha'),
(271, 19, 'Jabi Tehnan'),
(272, 19, 'Bure (AM)'),
(273, 19, 'Wemberma'),
(274, 19, 'Bahir Dar town'),
(275, 19, 'Debub Achefer'),
(276, 19, 'Finote Selam town'),
(277, 19, 'Debub Mecha'),
(278, 19, 'Shendi town'),
(279, 19, 'Denbecha town'),
(280, 19, 'Gonje'),
(281, 19, 'Dure Bete'),
(282, 19, 'Jiga town'),
(283, 19, 'Merawi town'),
(285, 19, 'Adete town'),
(286, 20, 'Zequala'),
(287, 20, 'Sekota'),
(288, 20, 'Dehana'),
(289, 20, 'Gaz Gibla'),
(290, 20, 'Abergele (AM)'),
(291, 20, 'Sahila'),
(292, 20, 'Sekota town'),
(293, 20, 'Tsagbeji'),
(294, 20, 'Amde Work town'),
(295, 21, 'Dangila'),
(296, 21, 'Banja'),
(297, 21, 'Ankasha'),
(298, 21, 'Guangua'),
(299, 21, 'Fagta Lakoma'),
(300, 21, 'Jawi'),
(301, 21, 'Guagusa Shikudad'),
(302, 21, 'Ayehu Guwagusa'),
(303, 21, 'Agew Gimija Bet'),
(304, 21, 'Adiss Kidame town'),
(305, 21, 'Tilili town'),
(306, 21, 'Fendika town'),
(307, 21, 'Injibara town'),
(308, 21, 'Zigem'),
(309, 21, 'Dangila town'),
(310, 21, 'Chagni town'),
(311, 22, 'Dewa Cheffa'),
(312, 22, 'Bati'),
(313, 22, 'Jilye Tumuga'),
(314, 22, 'Artuma Fursi'),
(315, 22, 'Dewa Harewa'),
(316, 22, 'Kemisie town'),
(317, 22, 'Chef Robit town'),
(318, 22, 'Senbete town'),
(319, 22, 'Bati Town'),
(320, 23, 'Amba Giorgis town'),
(321, 23, 'Shawra town'),
(322, 23, 'Kolla Debba town'),
(323, 23, 'Chilga 1'),
(324, 23, 'Tegede'),
(325, 23, 'Lay Armacho'),
(326, 23, 'Wegera'),
(327, 23, 'Gonder Zuria'),
(328, 23, 'East Dembia'),
(329, 23, 'Chilga 2'),
(330, 23, 'Alefa'),
(331, 23, 'West Belesa'),
(332, 23, 'East Belesa'),
(333, 23, 'Gondar town'),
(334, 23, 'Masero Denb /Central Armacho'),
(335, 23, 'Tach Armacho'),
(336, 23, 'Takusa'),
(337, 23, 'Kinfaz Begela'),
(338, 23, 'West Dembiya'),
(339, 23, 'Aykel town'),
(340, 24, 'Adagn Ager Chaqo'),
(341, 24, 'Mirab Armacho'),
(342, 24, 'Metema'),
(343, 24, 'Quara'),
(344, 24, 'Midre Genet'),
(345, 24, 'Metema Yohanes town'),
(346, 24, 'Gendawuha town'),
(347, 25, 'Mana Sibu'),
(348, 25, 'Nejo'),
(349, 25, 'Gimbi'),
(350, 25, 'Lalo Asabi'),
(351, 25, 'Kiltu Kara'),
(352, 25, 'Boji Dirmeji'),
(353, 25, 'Ayira'),
(354, 25, 'Jarso (West Wellega)'),
(355, 25, 'Gudetu Kondole'),
(356, 25, 'Boji Chekorsa'),
(357, 25, 'Babo'),
(358, 25, 'Yubdo'),
(359, 25, 'Gaji'),
(360, 25, 'Haru'),
(361, 25, 'Nole Kaba'),
(362, 25, 'Begi'),
(363, 25, 'Homa'),
(364, 25, 'Sayo Nole'),
(365, 25, 'Guliso'),
(366, 25, 'Gimbi town'),
(367, 25, 'Leta Sibu'),
(368, 25, 'Mendi town'),
(369, 25, 'Nejo town'),
(370, 26, 'Limu (OR)'),
(371, 26, 'Ibantu'),
(372, 26, 'Gida Ayana'),
(373, 26, 'Haro Limu'),
(374, 26, 'Boneya Boshe'),
(375, 26, 'Wayu Tuka'),
(376, 26, 'Bila Seyo'),
(377, 26, 'Gobu Seyo'),
(378, 26, 'Sibu Sire'),
(379, 26, 'Diga'),
(380, 26, 'Sasiga'),
(381, 26, 'Leka Dulecha'),
(382, 26, 'Guto Gida'),
(383, 26, 'Jimma Arjo'),
(384, 26, 'Nunu Kumba'),
(385, 26, 'Wama Hagalo'),
(386, 26, 'Kiremu'),
(387, 26, 'Nekemte town'),
(388, 27, 'Darimu'),
(389, 27, 'Alge Sachi'),
(390, 27, 'Yayu'),
(391, 27, 'Metu Zuria'),
(392, 27, 'Ale'),
(393, 27, 'Bure (OR)'),
(394, 27, 'Sale Nono'),
(395, 27, 'Becho (Ilu Aba Bora)'),
(396, 27, 'Bilo Nopha'),
(397, 27, 'Hurumu'),
(398, 27, 'Didu'),
(399, 27, 'Halu /Huka'),
(400, 27, 'Metu town'),
(401, 27, 'Dorani'),
(402, 28, 'Limu Seka'),
(403, 28, 'Limu Kosa'),
(404, 28, 'Sekoru'),
(405, 28, 'Tiro Afeta'),
(406, 28, 'Kersa (Jimma)'),
(407, 28, 'Mena (Jimma)'),
(408, 28, 'Goma'),
(409, 28, 'Gera'),
(410, 28, 'Seka Chekorsa'),
(411, 28, 'Dedo'),
(412, 28, 'Omo Nada'),
(413, 28, 'Sigmo'),
(414, 28, 'Setema'),
(415, 28, 'Shebe Sambo'),
(416, 28, 'Chora (Jimma)'),
(417, 28, 'Gumay'),
(418, 28, 'Agaro town'),
(419, 28, 'Jimma town'),
(420, 28, 'Mancho'),
(421, 28, 'Omo Beyam'),
(422, 28, 'Botor Tolay'),
(423, 28, 'Nono Benja'),
(424, 29, 'Illu Galan'),
(425, 29, 'Ginde Beret'),
(426, 29, 'Jeldu'),
(427, 29, 'Ambo Zuria'),
(428, 29, 'Mida Kegn'),
(429, 29, 'Cheliya'),
(430, 29, 'Bako Tibe'),
(431, 29, 'Dano'),
(432, 29, 'Nono'),
(433, 29, 'Tikur Enchini'),
(434, 29, 'Dendi'),
(435, 29, 'Ejere /Addis Alem'),
(436, 29, 'Adda Berga'),
(437, 29, 'Meta Robi'),
(438, 29, 'Ambo town'),
(439, 29, 'Abuna Ginde Beret'),
(440, 29, 'Toke Kutaye'),
(441, 29, 'Jibat'),
(442, 29, 'Ifata'),
(443, 29, 'Ejersa Lafo'),
(444, 29, 'Cobi'),
(445, 29, 'Meta Walkite'),
(446, 29, 'Liban Jawi'),
(447, 30, 'Wara Jarso'),
(448, 30, 'Dera (OR)'),
(449, 30, 'Hidabu Abote'),
(450, 30, 'Kuyu'),
(451, 30, 'Degem'),
(452, 30, 'Gerar Jarso'),
(453, 30, 'Debre Libanos'),
(454, 30, 'Wuchale'),
(455, 30, 'Abichugna Gne\'a'),
(456, 30, 'Kimbibit'),
(457, 30, 'Fiche town'),
(458, 30, 'Yaya Gulele'),
(459, 30, 'Jida'),
(460, 30, 'Aleltu'),
(461, 31, 'Fentale'),
(462, 31, 'Boset'),
(463, 31, 'Adama'),
(464, 31, 'Lome (OR)'),
(465, 31, 'Gimbichu'),
(466, 31, 'Ada\'a'),
(467, 31, 'Dugda'),
(468, 31, 'Adama Tulu Jido Kombolcha'),
(469, 31, 'Bishoftu town'),
(470, 31, 'Bora (OR)'),
(471, 31, 'Liben Chukala'),
(472, 31, 'Adama town'),
(473, 31, 'Mojo Town'),
(474, 31, 'Metehara town'),
(475, 32, 'Merti'),
(476, 32, 'Aseko'),
(477, 32, 'Golocha'),
(478, 32, 'Jeju'),
(479, 32, 'Dodota'),
(480, 32, 'Ziway Dugda'),
(481, 32, 'Hitosa'),
(482, 32, 'Sude'),
(483, 32, 'Chole'),
(484, 32, 'Amigna'),
(485, 32, 'Seru'),
(486, 32, 'Robe'),
(487, 32, 'Tena'),
(488, 32, 'Shirka'),
(489, 32, 'Degeluna Tijo'),
(490, 32, 'Tiyo'),
(491, 32, 'Munessa'),
(492, 32, 'Limu Bilbilo'),
(493, 32, 'Guna'),
(494, 32, 'Sire'),
(495, 32, 'Lude Hitosa'),
(496, 32, 'Diksis'),
(497, 32, 'Bele Gesgar'),
(498, 32, 'Inkolo Wabe'),
(499, 32, 'Asela town'),
(500, 32, 'Shanan Kolu'),
(501, 32, 'Bekoji town'),
(502, 33, 'Mieso'),
(503, 33, 'Doba'),
(504, 33, 'Tulo (OR)'),
(505, 33, 'Mesela'),
(506, 33, 'Chiro town'),
(507, 33, 'Anchar'),
(508, 33, 'Goba Koricha'),
(509, 33, 'Habro'),
(510, 33, 'Daro Lebu'),
(511, 33, 'Boke'),
(512, 33, 'Kuni /Oda Bultum'),
(513, 33, 'Gemechis'),
(514, 33, 'Chiro Zuria'),
(515, 33, 'Bedesa'),
(516, 33, 'Hawi Gudina'),
(517, 33, 'Gumbi Bordede'),
(518, 33, 'Burqua Dhintu'),
(519, 34, 'Babile town'),
(520, 34, 'Kombolcha'),
(521, 34, 'Jarso (East Hararghe)'),
(522, 34, 'Gursum (OR)'),
(523, 34, 'Babile (OR)'),
(524, 34, 'Fedis'),
(525, 34, 'Haro Maya'),
(526, 34, 'Kurfa Chele'),
(527, 34, 'Kersa (East Hararge)'),
(528, 34, 'Meta'),
(529, 34, 'Goro Gutu'),
(530, 34, 'Deder'),
(531, 34, 'Melka Balo'),
(532, 34, 'Bedeno'),
(533, 34, 'Midhaga Tola'),
(534, 34, 'Chinaksen'),
(535, 34, 'Girawa'),
(536, 34, 'Golo Oda'),
(537, 34, 'Meyu Muleke'),
(538, 34, 'Haromaya town'),
(539, 34, 'Goro Muti'),
(540, 34, 'Deder town'),
(541, 34, 'Kumbi'),
(542, 34, 'Aweday town'),
(543, 35, 'Agarfa'),
(544, 35, 'Gasera'),
(545, 35, 'Sinana'),
(546, 35, 'Goba (OR)'),
(547, 35, 'Harena Buluk'),
(548, 35, 'Mena (Bale)'),
(549, 35, 'Meda Welabu'),
(550, 35, 'Berbere'),
(551, 35, 'Gura Damole'),
(552, 35, 'Goro (Bale)'),
(553, 35, 'Robe Town'),
(554, 35, 'Goba town'),
(555, 35, 'Dinsho'),
(556, 36, 'Yabelo'),
(557, 36, 'Arero'),
(558, 36, 'Moyale (OR)'),
(559, 36, 'Dire'),
(560, 36, 'Teltale'),
(561, 36, 'Miyo'),
(562, 36, 'Dilo'),
(563, 36, 'Dhas'),
(564, 36, 'Gomole'),
(565, 36, 'Guchi'),
(566, 36, 'Dubluk'),
(567, 36, 'Elwaya'),
(568, 36, 'Yabelo town'),
(569, 36, 'Wachile'),
(570, 37, 'Ameya'),
(571, 37, 'Wenchi'),
(572, 37, 'Waliso'),
(573, 37, 'Dawo'),
(574, 37, 'Ilu'),
(575, 37, 'Kersana Malima'),
(576, 37, 'Tole'),
(577, 37, 'Becho (SW Shewa)'),
(578, 37, 'Seden Sodo'),
(579, 37, 'Woliso town'),
(580, 37, 'Goro (SW Shewa)'),
(581, 37, 'Sodo Daci'),
(582, 38, 'Uraga'),
(583, 38, 'Bore'),
(584, 38, 'Adola'),
(585, 38, 'Wadera'),
(586, 38, 'Odo Shakiso'),
(587, 38, 'Liben'),
(588, 38, 'Dama'),
(589, 38, 'Arda Jila'),
(590, 38, 'Girja /Harenfema'),
(591, 38, 'Ana Sora'),
(592, 38, 'Saba Boru'),
(593, 38, 'Gora Dola'),
(594, 38, 'Negele town'),
(595, 38, 'Aga Wayu'),
(596, 38, 'Haro Walabu'),
(597, 38, 'Adola town'),
(598, 38, 'Gumi Idalo'),
(599, 38, 'Shakiso town'),
(600, 39, 'Bule Hora'),
(601, 39, 'Kercha'),
(602, 39, 'Hambela Wamena'),
(603, 39, 'Abaya'),
(604, 39, 'Dugda Dawa'),
(605, 39, 'Gelana (West Guji)'),
(606, 39, 'Melka Soda'),
(607, 39, 'Bule Hora town'),
(608, 39, 'Suro Berguda'),
(609, 39, 'Birbirsa Kojowa'),
(610, 40, 'Chora (Buno Bedele)'),
(611, 40, 'Dega'),
(612, 40, 'Dabo Hana'),
(613, 40, 'Gechi'),
(614, 40, 'Borecha'),
(615, 40, 'Dedesa'),
(616, 40, 'Meko'),
(617, 40, 'Bedele town'),
(618, 40, 'Bedele Zuria'),
(619, 40, 'Chwaka'),
(620, 41, 'Dodola town'),
(621, 41, 'Siraro'),
(622, 41, 'Shala'),
(623, 41, 'Arsi Negele'),
(624, 41, 'Kofele'),
(625, 41, 'Kore'),
(626, 41, 'Gedeb Asasa'),
(627, 41, 'Dodola'),
(628, 41, 'Kokosa'),
(629, 41, 'Nenesebo'),
(630, 41, 'Adaba'),
(631, 41, 'Shashemene town'),
(632, 41, 'Shashemene Zuria'),
(633, 41, 'Heban Arsi'),
(634, 41, 'Wondo'),
(635, 41, 'Bishan Guracha'),
(636, 41, 'Arsi Negele town'),
(637, 42, 'Hawa Galan'),
(638, 42, 'Yama Logi Welel'),
(639, 42, 'Dale Wabera'),
(640, 42, 'Gawo Kebe'),
(641, 42, 'Sayo'),
(642, 42, 'Denbi Dollo town'),
(643, 42, 'Anfilo'),
(644, 42, 'Dale Sadi'),
(645, 42, 'Gidami'),
(646, 42, 'Jimma Horo'),
(647, 42, 'Lalo Kile'),
(648, 42, 'Sedi Chenka'),
(649, 43, 'Horo'),
(650, 43, 'Shambu town'),
(651, 43, 'Guduru'),
(652, 43, 'Ababo'),
(653, 43, 'Abay Chomen'),
(654, 43, 'Jimma Genete'),
(655, 43, 'Jimma Rare'),
(656, 43, 'Jarte Jardega'),
(657, 43, 'Amuru'),
(658, 43, 'Abe Dongoro'),
(659, 43, 'Choman Guduru'),
(660, 43, 'Horo Buluk'),
(661, 44, 'Burayu'),
(662, 44, 'Lege Tafo-Lege Dadi town'),
(663, 44, 'Sululta town'),
(664, 44, 'Sebeta Hawas'),
(665, 44, 'Dukem'),
(666, 44, 'Sebeta town'),
(667, 44, 'Bereh'),
(668, 44, 'Akaki'),
(669, 44, 'Sululta'),
(670, 44, 'Welmera'),
(671, 44, 'Mulo'),
(672, 44, 'Sendafa town'),
(673, 44, 'Holeta town'),
(674, 44, 'Gelana (Finfine)'),
(675, 45, 'Gololcha Bale'),
(676, 45, 'Lege Hida'),
(677, 45, 'Ginir'),
(678, 45, 'Rayitu'),
(679, 45, 'Seweyna'),
(680, 45, 'Dawe Ketchen'),
(681, 45, 'Ginir town'),
(682, 46, 'Ayisha'),
(683, 46, 'Dembel'),
(684, 46, 'Shinile'),
(685, 46, 'Erer (SM)'),
(686, 46, 'Afdem'),
(687, 46, 'Hadhagala'),
(688, 46, 'Miesso'),
(689, 46, 'Gota-Biki'),
(690, 46, 'Gablalu'),
(691, 47, 'Gursum (SM)'),
(692, 47, 'Babile (SM)'),
(693, 47, 'Shabeeley'),
(694, 47, 'Aw-Bare'),
(695, 47, 'Kebribeyah'),
(696, 47, 'Harshin'),
(697, 47, 'Tuliguled'),
(698, 47, 'Goljano'),
(699, 47, 'Jigjiga town'),
(700, 47, 'Wajale town'),
(701, 47, 'Kebribayah town'),
(702, 47, 'Koran /Mulla'),
(703, 47, 'Haroreys'),
(704, 47, 'Harawo'),
(705, 48, 'Degehamedo'),
(706, 48, 'Degehabur'),
(707, 48, 'Aware'),
(708, 48, 'Gashamo'),
(709, 48, 'Gunagado'),
(710, 48, 'Bilcil-Bur'),
(711, 48, 'Degahabur town'),
(712, 48, 'Yocale'),
(713, 48, 'Daror'),
(714, 48, 'Burqod'),
(715, 48, 'Ararso'),
(716, 48, 'Dig'),
(717, 49, 'Fik'),
(718, 49, 'Salahad'),
(719, 49, 'Hamero'),
(720, 49, 'Lagahida'),
(721, 49, 'Meyumuluka'),
(722, 49, 'Qubi'),
(723, 49, 'Yahob'),
(724, 49, 'Wangey'),
(725, 50, 'Shaygosh'),
(726, 50, 'Kebridehar'),
(727, 50, 'Shilabo'),
(728, 50, 'Debeweyin'),
(729, 50, 'Marsin'),
(730, 50, 'Kebridehar town'),
(731, 50, 'Goglo'),
(732, 50, 'Lasdhankayre'),
(733, 50, 'Higloley'),
(734, 50, 'El-Ogaden'),
(735, 50, 'Bodaley'),
(736, 51, 'East Imi'),
(737, 51, 'Adadle'),
(738, 51, 'Danan'),
(739, 51, 'Gode'),
(740, 51, 'Kelafo'),
(741, 51, 'Mustahil'),
(742, 51, 'Ferfer'),
(743, 51, 'Berocano'),
(744, 51, 'Godey town'),
(745, 51, 'Elale'),
(746, 51, 'Aba-Korow'),
(747, 52, 'Danod'),
(748, 52, 'Bokh'),
(749, 52, 'Galadi'),
(750, 52, 'Warder'),
(751, 52, 'Daratole'),
(752, 52, 'Lehel-Yucub'),
(753, 52, 'Galhamur'),
(754, 53, 'Charati'),
(755, 53, 'Elkare /Serer'),
(756, 53, 'West Imi'),
(757, 53, 'Hargele'),
(758, 53, 'Barey'),
(759, 53, 'Dolobay'),
(760, 53, 'Raso'),
(761, 53, 'Kohle /Qoxle'),
(762, 53, 'God-God'),
(763, 54, 'Filtu'),
(764, 54, 'Dolo Ado'),
(765, 54, 'Goro Baqaqsa'),
(766, 54, 'Guradamole'),
(767, 54, 'Deka Suftu'),
(768, 54, 'Bokolmayo'),
(769, 55, 'Ayun'),
(770, 55, 'Elwayne'),
(771, 55, 'Garbo'),
(772, 55, 'Sagag'),
(773, 55, 'Dihun'),
(774, 55, 'Horshagah'),
(775, 55, 'Hararey'),
(776, 56, 'Moyale (SM)'),
(777, 56, 'Hudet'),
(778, 56, 'Mubarek'),
(779, 56, 'Qada Duma'),
(780, 57, 'Gilgel Beles town'),
(781, 57, 'Dangur'),
(782, 57, 'Guba'),
(783, 57, 'Wembera'),
(784, 57, 'Mandura'),
(785, 57, 'Dibate'),
(786, 57, 'Pawe'),
(787, 57, 'Bulen'),
(788, 58, 'Menge'),
(789, 58, 'Kurmuk'),
(790, 58, 'Assosa'),
(791, 58, 'Sherkole'),
(792, 58, 'Bambasi'),
(793, 58, 'Bilidigilu'),
(794, 58, 'Homosha'),
(795, 58, 'Undulu'),
(796, 58, 'Assosa town Administration'),
(797, 59, 'Kamashi town'),
(798, 59, 'Zayi'),
(799, 59, 'Sedal'),
(800, 59, 'Kamashi'),
(801, 59, 'Dembe'),
(802, 59, 'Mizyiga'),
(803, 60, 'Maokomo Special'),
(804, 61, 'Kebena'),
(805, 61, 'Abeshege'),
(806, 61, 'Ezha'),
(807, 61, 'Gedebano Gutazer Welene'),
(808, 61, 'Sodo'),
(809, 61, 'Meskan'),
(810, 61, 'Mareko'),
(811, 61, 'Endiguagn'),
(812, 61, 'Gumer'),
(813, 61, 'Cheha'),
(814, 61, 'Enemor Ener'),
(815, 61, 'Muhur Na Aklil'),
(816, 61, 'Geta'),
(817, 61, 'Welkite town'),
(818, 61, 'Butajira town'),
(819, 61, 'Emdebir town'),
(820, 61, 'Bui town'),
(821, 61, 'Misrak Meskan'),
(822, 61, 'Debub Sodo'),
(823, 61, 'Enor Ener'),
(824, 62, 'Misha'),
(825, 62, 'Gombora'),
(826, 62, 'Lemmo'),
(827, 62, 'Shashogo'),
(828, 62, 'Misrak Badawacho'),
(829, 62, 'Soro'),
(830, 62, 'Duna'),
(831, 62, 'Analemmo'),
(832, 62, 'Mirab Badowach'),
(833, 62, 'Gibe'),
(834, 62, 'Hosaena town'),
(835, 62, 'Shone Town'),
(836, 62, 'Gimbichu town'),
(837, 62, 'Jajura town'),
(838, 62, 'Ameka'),
(839, 62, 'Siraro Badawacho'),
(840, 62, 'Mirab Soro'),
(841, 63, 'Tembaro'),
(842, 63, 'Angacha'),
(843, 63, 'Kediada Gambela'),
(844, 63, 'Kacha Bira'),
(845, 63, 'Hadero Tunto'),
(846, 63, 'Doyogena'),
(847, 63, 'Damboya'),
(848, 63, 'Durame town'),
(849, 63, 'Adilo'),
(850, 63, 'Shinshincho town'),
(851, 63, 'Hadero town'),
(852, 64, 'Wenago'),
(853, 64, 'Yirgachefe'),
(854, 64, 'Kochere'),
(855, 64, 'Bule'),
(856, 64, 'Dila Zuria'),
(857, 64, 'Gedeb'),
(858, 64, 'Dila town'),
(859, 64, 'Chelelektu town'),
(860, 64, 'Rape'),
(861, 64, 'Churso'),
(862, 64, 'Gedeb town'),
(863, 64, 'Yirgachefe town'),
(864, 65, 'Boloso Sore'),
(865, 65, 'Damot Gale'),
(866, 65, 'Damot Woide'),
(867, 65, 'Humbo'),
(868, 65, 'Sodo Zuria'),
(869, 65, 'Kindo Koyesha'),
(870, 65, 'Ofa'),
(871, 65, 'Boloso Bombe'),
(872, 65, 'Damot Sore'),
(873, 65, 'Kindo Daddaye'),
(874, 65, 'Damot Pullasa'),
(875, 65, 'Duguna Fango'),
(876, 65, 'Sodo Town'),
(877, 65, 'Areka town'),
(878, 65, 'Boditi town'),
(879, 65, 'Tebela town'),
(880, 65, 'Gesuba town'),
(881, 65, 'Gununo Hamus town'),
(882, 65, 'Hobicha Abaya'),
(883, 65, 'Kawo Koisha'),
(884, 65, 'Abela Abaya'),
(885, 65, 'Bayera Koisha'),
(886, 66, 'Salamago'),
(887, 66, 'South Ari'),
(888, 66, 'North Ari'),
(889, 66, 'Hamer'),
(890, 66, 'Bena Tsemay'),
(891, 66, 'Dasenech /Kuraz'),
(892, 66, 'Malie'),
(893, 66, 'Nyngatom'),
(894, 66, 'Jinka town'),
(895, 66, 'Boko Dawula'),
(896, 66, 'Wub Ari'),
(897, 67, 'Selamber town'),
(898, 67, 'Boreda'),
(899, 67, 'Mirab Abaya'),
(900, 67, 'Chencha Zuriya'),
(901, 67, 'Ezo /Kogota'),
(902, 67, 'Dita'),
(903, 67, 'Daramalo'),
(904, 67, 'Chencha'),
(905, 67, 'Kemba'),
(906, 67, 'Kemba town'),
(907, 67, 'Gerese'),
(908, 67, 'Bonke'),
(909, 67, 'Arba Minch Zuria'),
(910, 67, 'Gacho Baba'),
(911, 67, 'Kucha Alpha'),
(912, 67, 'Garda Marta'),
(913, 67, 'Kucha'),
(914, 67, 'Arba Minch town'),
(915, 68, 'Alle Special'),
(916, 69, 'Karat town'),
(917, 69, 'Segen Zuria'),
(918, 69, 'Karat Zuria'),
(919, 69, 'Kena'),
(920, 70, 'Kulito town'),
(921, 70, 'Wera'),
(922, 70, 'Atote Ulo'),
(923, 70, 'Wera Djo'),
(924, 71, 'Melekoza'),
(925, 71, 'Denba Gofa'),
(926, 71, 'Zala'),
(927, 71, 'Uba Debre Tsehay'),
(928, 71, 'Gezei Gofa'),
(929, 71, 'O\'yida'),
(930, 71, 'Sawla town'),
(931, 71, 'Bulike town'),
(932, 71, 'Melo Gada'),
(933, 72, 'Basketo SP Woreda'),
(934, 73, 'Alicho Woriro'),
(935, 73, 'Siltie'),
(936, 73, 'Lanfero'),
(937, 73, 'Mierab Azenet Berbere'),
(938, 73, 'Dalocha'),
(939, 73, 'Sankura'),
(940, 73, 'Misrak Azenet Berbere'),
(941, 73, 'Wulbareg'),
(942, 73, 'Tora town'),
(943, 73, 'Worabe town'),
(944, 73, 'Kibet town'),
(945, 73, 'Mito'),
(946, 73, 'Misrak Siltie'),
(947, 74, 'Amaro'),
(948, 75, 'Burji Special'),
(949, 76, 'Derashe Special'),
(950, 77, 'Yem SP Woreda'),
(951, 78, 'Anderacha'),
(952, 78, 'Masha'),
(953, 78, 'Yeki'),
(954, 78, 'Tepi'),
(955, 78, 'Masha town'),
(956, 79, 'Saylem'),
(957, 79, 'Gesha'),
(958, 79, 'Gewata'),
(959, 79, 'Gimbo'),
(960, 79, 'Adiyio'),
(961, 79, 'Tullo'),
(962, 79, 'Cheta'),
(963, 79, 'Decha'),
(964, 79, 'Chena'),
(965, 79, 'Bita'),
(966, 79, 'Bonga town'),
(967, 79, 'Goba (SP)'),
(968, 79, 'Shisho Ande'),
(969, 79, 'Wacha'),
(970, 80, 'Sheko'),
(971, 80, 'Gurafereda'),
(972, 80, 'Debub Bench'),
(973, 80, 'Shay Bench'),
(974, 80, 'Semen Bench'),
(975, 80, 'Gidi Bench'),
(976, 80, 'Mizan Aman town'),
(977, 80, 'Size town'),
(978, 81, 'Tocha'),
(979, 81, 'Mareka'),
(980, 81, 'Loma'),
(981, 81, 'Gena'),
(982, 81, 'Isara'),
(983, 81, 'Kachi'),
(984, 81, 'Tercha Zuriya'),
(985, 81, 'Mari Mansa'),
(986, 81, 'Disa'),
(987, 81, 'Zabagazo'),
(988, 81, 'Tercha town'),
(989, 81, 'Gesa town'),
(990, 82, 'Gachit'),
(991, 82, 'Menit Goldiye'),
(992, 82, 'Gori Gesha'),
(993, 82, 'Menit Shasha'),
(994, 82, 'Bero'),
(995, 82, 'Surma'),
(996, 82, 'Maji'),
(997, 83, 'Konta'),
(998, 84, 'Akobo'),
(999, 84, 'Lare'),
(1000, 84, 'Jikawo'),
(1001, 84, 'Wantawo'),
(1002, 84, 'Makuey'),
(1003, 85, 'Gambela National Park'),
(1004, 85, 'Abobo'),
(1005, 85, 'Gambela Zuria'),
(1006, 85, 'Gog'),
(1007, 85, 'Jore'),
(1008, 85, 'Dima (GM)'),
(1009, 85, 'Gambela town'),
(1010, 86, 'Godere'),
(1011, 86, 'Mengesh'),
(1012, 87, 'Itang'),
(1013, 88, 'Sofi'),
(1014, 88, 'Shenkor'),
(1015, 88, 'Jinela'),
(1016, 88, 'Hakim'),
(1017, 88, 'Erer (HR)'),
(1018, 88, 'Dire Teyara'),
(1019, 88, 'Amir Nur'),
(1020, 88, 'Aboker'),
(1021, 88, 'Abadir'),
(1022, 89, 'Akaki Kality'),
(1023, 89, 'Nifas Silk Lafto'),
(1024, 89, 'Kolfe Keraniyo'),
(1025, 89, 'Bole'),
(1026, 89, 'Lideta'),
(1027, 89, 'Kirkos'),
(1028, 89, 'Yeka'),
(1029, 89, 'Addis Ketema'),
(1030, 89, 'Arada'),
(1031, 89, 'Gulele'),
(1032, 89, 'Lemi Kura'),
(1033, 90, 'Sabian'),
(1034, 90, 'Malka Jabti /M.Jebdu)'),
(1035, 90, 'Legehare'),
(1036, 90, 'Addis Ketema (DD)'),
(1037, 90, 'Gende Kore'),
(1038, 90, 'Dechatu'),
(1039, 90, 'Hafat Issa'),
(1040, 90, 'Kazira'),
(1041, 90, 'Police Maret'),
(1042, 90, 'Aseliso'),
(1043, 90, 'Jeldessa'),
(1044, 90, 'Wahil'),
(1045, 90, 'Biyoawale'),
(1046, 91, 'Shebe Dino'),
(1047, 91, 'Hawassa Zuria'),
(1048, 91, 'Arbegona'),
(1049, 91, 'Dale'),
(1050, 91, 'Aleta Wendo'),
(1051, 91, 'Dara'),
(1052, 91, 'Hulla'),
(1053, 91, 'Bensa'),
(1054, 91, 'Aroresa'),
(1055, 91, 'Boricha'),
(1056, 91, 'Gorche'),
(1057, 91, 'Malga'),
(1058, 91, 'Wonosho'),
(1059, 91, 'Chire'),
(1060, 91, 'Bursa'),
(1061, 91, 'Aleta Chuko'),
(1062, 91, 'Bona Zuria'),
(1063, 91, 'Hawasa town'),
(1064, 91, 'Wondo-Genet'),
(1065, 91, 'Yirgalem town'),
(1066, 91, 'Aleta Wondo town'),
(1067, 91, 'Leku town'),
(1068, 91, 'Hawela'),
(1069, 91, 'Bura'),
(1070, 91, 'Dara Otilicho'),
(1071, 91, 'Teticha'),
(1072, 91, 'Chirone'),
(1073, 91, 'Shafamo'),
(1074, 91, 'Chabe Gambeltu'),
(1075, 91, 'Daye town'),
(1076, 91, 'Hokko'),
(1077, 91, 'Bilate Zuria'),
(1078, 91, 'Darara'),
(1079, 91, 'Daella'),
(1080, 91, 'Chuko town'),
(1081, 91, 'Wondo-Genet town'),
(1082, 91, 'Loka Abaya'),
(2844, 19, 'Bure town');

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

DROP TABLE IF EXISTS `zone`;
CREATE TABLE IF NOT EXISTS `zone` (
  `zoneId` int(11) NOT NULL AUTO_INCREMENT,
  `stateId` int(11) NOT NULL,
  `zoneName` varchar(100) NOT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`zoneId`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`zoneId`, `stateId`, `zoneName`, `isDeleted`) VALUES
(1, 1, 'North Western', 0),
(2, 1, 'Central', 0),
(3, 1, 'Eastern', 0),
(4, 1, 'Southern', 0),
(5, 1, 'Western', 0),
(6, 1, 'South Eastern', 0),
(7, 1, 'Mekelle', 0),
(8, 5, 'Awsi /Zone 1', 0),
(9, 5, 'Kilbati /Zone2', 0),
(10, 5, 'Gabi /Zone 3', 0),
(11, 5, 'Fanti /Zone 4', 0),
(12, 5, 'Hari /Zone 5', 0),
(13, 2, 'North Gondar', 0),
(14, 2, 'South Gondar', 0),
(15, 2, 'North Wello', 0),
(16, 2, 'South Wello', 0),
(17, 2, 'North Shewa', 0),
(18, 2, 'East Gojam', 0),
(19, 2, 'West Gojam', 0),
(20, 2, 'Wag Hamra', 0),
(21, 2, 'Awi', 0),
(22, 2, 'Oromia', 0),
(23, 2, 'Central Gondar', 0),
(24, 2, 'West Gondar', 0),
(25, 3, 'West Wellega', 0),
(26, 3, 'East Wellega', 0),
(27, 3, 'Ilu Aba Bora', 0),
(28, 3, 'Jimma', 0),
(29, 3, 'West Shewa', 0),
(30, 3, 'North Shewa', 0),
(31, 3, 'East Shewa', 0),
(32, 3, 'Arsi', 0),
(33, 3, 'West Hararge', 0),
(34, 3, 'East Hararge', 0),
(35, 3, 'Bale', 0),
(36, 3, 'Borena', 0),
(37, 3, 'South West Shewa', 0),
(38, 3, 'Guji', 0),
(39, 3, 'West Guji', 0),
(40, 3, 'Buno Bedele', 0),
(41, 3, 'West Arsi', 0),
(42, 3, 'Kelem Wellega', 0),
(43, 3, 'Horo Gudru Wellega', 0),
(44, 3, 'Finfine Special', 0),
(45, 3, 'East Bale', 0),
(46, 4, 'Siti', 0),
(47, 4, 'Fafan', 0),
(48, 4, 'Jarar', 0),
(49, 4, 'Erer', 0),
(50, 4, 'Korahe', 0),
(51, 4, 'Shabelle', 0),
(52, 4, 'Doolo', 0),
(53, 4, 'Afder', 0),
(54, 4, 'Liban', 0),
(55, 4, 'Nogob', 0),
(56, 4, 'Daawa', 0),
(57, 8, 'Metekel', 0),
(58, 8, 'Assosa', 0),
(59, 8, 'Kamashi', 0),
(60, 8, 'Mao Komo Special', 0),
(61, 10, 'Guraghe', 0),
(62, 10, 'Hadiya', 0),
(63, 10, 'Kembata Tembaro', 0),
(64, 10, 'Gedeo', 0),
(65, 10, 'Wolayita', 0),
(66, 10, 'South Omo', 0),
(67, 10, 'Gamo', 0),
(68, 10, 'Alle', 0),
(69, 10, 'Konso', 0),
(70, 10, 'Halaba', 0),
(71, 10, 'Gofa', 0),
(72, 10, 'Basketo', 0),
(73, 10, 'Siltie', 0),
(74, 10, 'Amaro', 0),
(75, 10, 'Burji', 0),
(76, 10, 'Derashe', 0),
(77, 10, 'Yem Special', 0),
(78, 11, 'Sheka', 0),
(79, 11, 'Sheka', 0),
(80, 11, 'Bench Sheko', 0),
(81, 11, 'Dawuro', 0),
(82, 11, 'Mirab Omo', 0),
(83, 11, 'Konta Special', 0),
(84, 6, 'Nuwer', 0),
(85, 6, 'Agnewak', 0),
(86, 6, 'Majang', 0),
(87, 6, 'Itang Special woreda', 0),
(88, 7, 'Harari', 0),
(89, 12, 'Addis Ababa', 0),
(90, 13, 'Dire Dawa', 0),
(91, 9, 'Sidama', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
